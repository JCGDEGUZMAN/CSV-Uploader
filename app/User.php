<?php

namespace App;

use App\Distributor;
Use App\DistributorUser;
use App\Dealer;
use App\DealerUser;
use App\DistributorDealer;
use App\Imports\AdminUsersImport;
use App\Imports\DistributorUsersImport;
use App\Imports\DistributorOwnerImport;
use App\Imports\DealerOwnerImport;
use App\Imports\DealerUsersImport;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'mobile_number', 'password', 'group', 'access',  
        'street', 'barangay', 'city', 'province', 'zone', 'region', 'zip_code', 'photo', 'sales_coordinator', 'capacity',
        'is_owner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function convertCsvFileDataToArray($file)
    {
        $file = file_get_contents($file);  

        $array_data = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));

        return  $array_data;
    }

    public static function importAdminUsers($file)
    {
        Excel::import(new AdminUsersImport,$file);
           
        return redirect()->back()->with('message', 'Admin Import Successful!');
    }

    public static function importDistributors($file)
    {
        $unique_exist_row = [];
        $success = " ";

        $data = self::convertCsvFileDataToArray($file);

        $rows = count($data);

        for($i = 1; $i<$rows-1; $i++)
        {
            $email_exist = self::where('email', '=', $data[$i][4])->first();

            if(!$email_exist)
            {

                $user_id = 0;
                $distributor_id = 0;

                $user_id = self::saveOnUsersTable($data[$i], 2);

                $distributor = new Distributor;

                $distributor->company_name = $data[$i][0];
                $distributor->assigned_categories = $data[$i][13];

                if($distributor->save())
                {
                    $distributor_id = $distributor->id;
                }

                $distributor_user = new DistributorUser;

                $distributor_user->user_id = $user_id;
                $distributor_user->distributor_id =$distributor_id;
                $distributor_user->is_distributor = 1;

                if ($distributor_user->save()) {

                    $success =  self::saveDistributorUserOwner($data[$i],$distributor_id);
                }

            }else{
                array_push($unique_exist_row, $i+1);
            }
        }

        if($unique_exist_row)
        {
            return redirect()->back()->with('error', 'Email in row(s) '. implode(', ',$unique_exist_row) . ' already EXIST not save in DB');
        
        }else{

            return redirect()->back()->with('message', $success);
        }
    }

    public static function saveDistributorUserOwner($data, $distributor_id)
    {
            $user_id = self::saveUserOwner($data, 2);

            $distributor_user = new DistributorUser;

            $distributor_user->user_id =  $user_id;
            $distributor_user->distributor_id =$distributor_id;
            $distributor_user->is_distributor = 0;

            if ($distributor_user->save()) {

                return 'Distributor Import Successful!';
            }
    }

    public static function saveOnUsersTable($data, $group)
    {
        $user = new User;

        $user->group = $group;
        $user->access = $data[16];
        $user->street = $data[11];
        $user->barangay = $data[10];
        $user->city = $data[9];
        $user->province = $data[8];
        $user->zone = $data[7];
        $user->region = $data[6];
        $user->zip_code = $data[12];
        $user->photo = $data[18];
        $user->photo = $data[18];
        $user->sales_coordinator = $data[14];
        $user->capacity = $data[15];

        if($user->save())
        {
            return $user->id;
        }
    }

    public static function saveUserOwner($data, $group)
    {
        $user = new User;

        $user->first_name = $data[1];
        $user->middle_name = $data[2];
        $user->last_name = $data[3];
        $user->group = $group;
        $user->access = $data[16];
        $user->email = $data[4];
        $user->mobile_number = $data[5];
        $user->password = Hash::make($data[17]);
        $user->is_owner = true;

        if ($user->save()) {
            return $user->id;
        }
    }

    public static function importDealers($file)
    {
        $unique_exist_row = [];
        $success = " ";

        $data = self::convertCsvFileDataToArray($file);
        
        $rows = count($data);

        for($i = 1; $i<$rows-1; $i++)
        {
            $email_exist = self::where('email', '=', $data[$i][4])->first();

            if(!$email_exist)
            {

                $user_id = 0;
                $dealer_id = 0;

                $user_id = self::saveOnUsersTable($data[$i], 3);
               
                $dealer = new Dealer;
                
                $dealer->dealer_name = $data[$i][0];

                if ($dealer->save()) {
                    $dealer_id = $dealer->id;
                }
                
                $dealer_user = new DealerUser;

                $dealer_user->user_id = $user_id;
                $dealer_user->dealer_id = $dealer_id;
                $dealer_user->is_dealer = true;

                if ($dealer_user->save()) {

                    $success =  self::saveDealerUserOwner($data[$i],$dealer_id);
                }

            }else{
                array_push($unique_exist_row, $i+1);
            }
        }

        if($unique_exist_row)
        {
            return redirect()->back()->with('error', 'Email in row(s) '. implode(', ',$unique_exist_row) . ' already EXIST not save in DB');
        
        }else{

            return redirect()->back()->with('message', $success);
        }
    }
    
    public static function saveDealerUserOwner($data, $dealer_id)
    {
            $user_id = self::saveUserOwner($data, 3);

            $dealer_user = new DealerUser;

            $dealer_user->user_id = $user_id;
            $dealer_user->dealer_id = $dealer_id;
            $dealer_user->is_dealer = false;

            if ($dealer_user->save()) {
                return self::saveDealerDistributor($dealer_id, $data[13]);
            }
    }

    public static function saveDealerDistributor($dealer_id, $distributor_email)
    {    
        $user_id = User::where('email', '=', $distributor_email)
            ->select('id')
            ->first();

        $distributor_id = DistributorUser::where('user_id', '=', $user_id["id"])
            ->select('distributor_id')
            ->first();
            
        $dist_deal = new DistributorDealer;

        $dist_deal->distributor_id = $distributor_id["distributor_id"];
        $dist_deal->dealer_id = $dealer_id;

        if ($dist_deal->save()) {
            return 'Dealer Import Successful!';
        }
    }
}
