<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 25px;
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .btn-link {
            color: #0d6efd;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-container">
                    <h1 style="text-align: center">Register Page</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            @if (session('success'))
                                {{ session('success') }}
                            @endif
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            @endif
                            @if (session('error'))
                                {{ session('error') }}
                            @endif
                        </div>
                    @endif
                    <form action="{{ route('postregister') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" required>
                            @error('namaLengkap')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                        <br>
                        <br>
                        <a href="{{ route('login') }}" class="btn btn-link w-100">Already have an account? Login
                            here!</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
