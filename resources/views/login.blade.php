<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Figtree, sans-serif;
            font-feature-settings: normal;
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('image/myPokemon.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class=" card p-4  col-4 offset-4 mt-5 shadow-sm">
        <div class="card-title text-center fs-3">Login Page</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mt-2">
                <label for="" class="mb-2">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mt-4">
                <label for="" class="mb-2">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="flex items-center justify-end mt-4">

                <a class="text-decoration-none text-dark text-center" href="{{ route('auth#registerPage') }}">
                    Don't you have account ? <span class="text-danger">Click Here</span>
                </a>


                <button class="btn btn-primary float-end">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>

</html>
