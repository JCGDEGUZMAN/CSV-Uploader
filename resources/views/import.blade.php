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
        }
    </style>
    <script>
        var msg = '{{session()->get('message')}}';
        var exist = '{{session()->has('message')}}';

        if(exist)
        {
            alert(msg);
        }
    </script>
</head>
<body>
    <div class="main-container">
        <div class="main-title">URC IMPORTER</div>
        <div class="importer-title">PRODUCT IMPORTER</div>
        <form action="{{ route('importProducts') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="product_file" class="importer-input">
            <button class="import-buttons">IMPORT PRODUCTS</button>
        </form>
    </div>
</body>
</html>