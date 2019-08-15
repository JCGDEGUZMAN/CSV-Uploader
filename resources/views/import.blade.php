<!DOCTYPE html>
<html>
<head>
    <title>URC IMPORTER</title>
    <style>
        .main-container {
            text-align: center;
            padding: 5rem;
        }

        .main-title {
            margin: 20px auto;
        }

        .importer-title {
            text-align: left;
        }

        .importer-input {
            position: absolute;
            left: 0;
            margin: 2rem 5.5rem;
        }

        .import-buttons {
            margin: 2rem auto;
            width: 15rem;
        }
    </style>
    <script>
        var success_msg = '{{session()->get('message')}}';
        var success_exist = '{{session()->has('message')}}';

        if(success_exist)
        {
            alert(success_msg);
        }

        var error_msg = '{{session()->get('error')}}';
        var error_exist = '{{session()->has('error')}}';

        if(error_exist)
        {
            alert(error_msg);
        }
    </script>
</head>
<body>
    <div class="main-container">
        <div class="main-title">URC IMPORTER</div>
        <form action="{{ route('importProducts') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="importer-title">PRODUCT IMPORTER</div>
            <input type="file" name="product_file" class="importer-input" required>
            <button class="import-buttons">IMPORT PRODUCTS</button>
        </form>
        <form action="{{ route('importAdminUsers') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="importer-title">ADMIN IMPORTER</div>
            <input type="file" name="admin_user_file" class="importer-input" required>
            <button class="import-buttons">IMPORT ADMINS</button>
        </form>
        <form action="{{ route('importDistributors') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="importer-title">DISTRIBUTOR IMPORTER</div>
            <input type="file" name="distributor_user_file" class="importer-input" required>
            <button class="import-buttons">IMPORT DISTRIBUTORS</button>
        </form>
    </div>
</body>
</html>