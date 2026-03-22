<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - FilmLane</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
       
    </style>
</head>
<body>

    <a href="/" class="back-home">
        <i class="fa-solid fa-arrow-left"></i> Back to Home
    </a>

    <div class="login-container">
        <div class="login-logo">
            <a href="/"><img src="{{ asset('images/logo.svg') }}" alt="FilmLane Logo" /></a>
        </div>

        <h2 class="login-title">Sign In</h2>

        <form action="#" method="POST">
            <div class="input-group">
                <label for="email">Email Address</label>
                <i class="fa-regular fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-actions">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                <a href="#" class="forgot-pass">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn">Sign In</button>
        </form>

        <div class="register-link">
            New to FilmLane? <a href="#">Sign up now</a>
        </div>
        <div class="warning">
            TAO CHƯA CÓ LÀM CHỨC NĂNG ĐĂNG NHẬP BÂY ƠI
        </div>
    </div>

</body>
</html>