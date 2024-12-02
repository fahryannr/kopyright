<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopyright Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');
        body {
            background-color: #343434;
            color: #F3F3F3;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background-color: #2a2a2a;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            font-family: 'Playfair Display', serif;
            color: #f0f0f0;
            font-weight: bold;
            font-style: normal;
            margin-bottom: 30px;
        }

        .form-control {
            background-color: #3a3a3a;
            border: none;
            color: #e0e0e0;
        }
        .form-control:focus {
            background-color: #3a3a3a;
            color: #e0e0e0;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        }
        .btn-login {
            background-color: #E9DCBE;
            color: rgba(0, 0, 0, 0.5);
            border: none;
        }
        .btn-login:hover {
            background-color: #8E8B82;
            color: #F3F3F3;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .cafe-logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4a4a4a;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="storage/foto/kopyright.jpg" alt="Cafe Logo" class="cafe-logo">
        </div>

        <div class="login-container">
            @if (Session::has('status'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('message') }}
            </div>
            @endif

            <h2 class="text-center login-title">Kopyright Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required value="{{ old('username') }}">
                    @error('username')
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
                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>