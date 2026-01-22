<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Bintianis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #fff5e2, #fff5e2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-wrapper {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            display: flex;
        }

        /* Sisi kiri (branding) */
        .login-left {
            width: 50%;
            background: linear-gradient(135deg, #dd9c24, #a85d1f);
            color: #ffffff;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .login-left p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Sisi kanan (form) */
        .login-right {
            width: 50%;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: #803900;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15,118,110,0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #e9a424, #e9a424);
            color: #ffffff;
            border: none;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .error-message {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 420px;
            }

            .login-left {
                width: 100%;
                text-align: center;
                padding: 40px 30px;
            }

            .login-right {
                width: 100%;
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Branding kiri -->
    <div class="login-left">
        <h1>Bintianis</h1>
        <p>
            Toko jajanan & kue rumahan di Palu dengan spesialisasi jajanan Arab.
            Silakan login untuk melanjutkan pemesanan.
        </p>
    </div>

    <!-- Form kanan -->
    <div class="login-right">

        <div class="login-title">Selamat Datang</div>
        <div class="login-subtitle">Silakan login untuk masuk ke akun Anda</div>

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Login</button>
        </form>

    </div>
</div>

</body>
</html>
