<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke MiFilms</title>

    <style>
        /* ==================================== */
        /* CSS LOGIN PAGE (INTERNAL) */
        /* ==================================== */
        
        /* -- Global Styles -- */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; /* Warna background gelap */
            color: #fff; /* Warna teks putih */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center; /* Pusatkan konten horizontal */
            justify-content: center; /* Pusatkan konten vertikal */
            min-height: 100vh; /* Pastikan mengambil seluruh tinggi viewport */
        }

        /* -- Header (Logo) -- */
        .header-logo {
            font-size: 2em;
            font-weight: bold;
            color: #ffd500; /* Warna kuning baru */
            text-decoration: none;
            margin-bottom: 20px;
            display: block; /* Agar bisa diatur margin */
            text-align: center;
        }

        hr {
            border: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2); /* Garis pemisah lebih samar */
            width: 100%;
            max-width: 400px; /* Lebar garis sama dengan form */
            margin: 20px 0 30px 0;
            text-align: center;
        }

        /* -- Login Container -- */
        .login-container {
            background-color: #2a2a2a; /* Background form sedikit lebih terang */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px; /* Lebar maksimal form */
            text-align: center; /* Pusatkan teks di dalam container */
        }

        .login-container h2 {
            font-size: 2em;
            margin-bottom: 30px;
            color: #fff;
        }

        /* -- Form Styling -- */
        .login-container form div {
            margin-bottom: 20px;
            text-align: left; /* Teks label rata kiri */
        }

        .login-container label {
            display: block; /* Label di baris sendiri */
            margin-bottom: 8px;
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.7);
            font-weight: bold;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            /* Hapus width: calc(100% - 20px); */
            width: 100%; /* Ubah menjadi 100% */
            padding: 12px 10px;
            border: 1px solid #444; 
            background-color: #333; 
            color: #fff;
            border-radius: 4px;
            font-size: 1em;
            /* Ini yang KUNCI: Memastikan padding tidak menambah lebar total */
            box-sizing: border-box; 
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #ffd500; /* Border kuning saat fokus */
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 213, 0, 0.3);
        }

        /* -- Button Styling -- */
        .login-container button[type="submit"] {
            background-color: #ffd500; /* Warna kuning tombol */
            color: #1a1a1a; /* Teks hitam */
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%; /* Lebar tombol penuh */
            margin-top: 10px;
        }

        .login-container button[type="submit"]:hover {
            background-color: #e0bb00; /* Warna kuning lebih gelap saat hover */
        }

        /* -- Error Messages -- */
        .login-container .error-message {
            color: #ff6b6b; /* Warna merah untuk pesan error */
            font-size: 0.85em;
            margin-top: 5px;
            display: block; /* Agar error bisa punya margin sendiri */
            text-align: left;
        }

        /* -- Link Register -- */
        .login-container p {
            margin-top: 30px;
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.6);
        }

        .login-container p a {
            color: #ffd500; /* Warna kuning untuk link Register */
            text-decoration: none;
            font-weight: bold;
        }

        .login-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <a href="{{ route('home') }}" class="header-logo">
        MiFilms
    </a>

    <hr>

    <div class="login-container">
        <h2>Login ke Akun Lo</h2>
        
        <form method="POST" action="{{ route('login.action') }}">
            @csrf
            
            <div>
                <label for="loginname">Username atau Email</label>
                <input type="text" name="loginname" id="loginname" required value="{{ old('loginname') }}">
                
                @error('loginname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="loginpassword">Password</label>
                <input type="password" name="loginpassword" id="loginpassword" required>
                
                @error('loginpassword')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">
                Login
            </button>
        </form>

        <p>
            Belum punya akun? <a href="{{ route('register') }}">Register di sini</a>
        </p>
    </div>

</body>
</html>