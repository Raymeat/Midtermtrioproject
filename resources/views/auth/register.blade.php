<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun MiFilms</title>

    <style>
        /* ==================================== */
        /* CSS REGISTER PAGE (ADAPTASI DARI LOGIN) */
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
            color: #ffd500; /* Warna kuning */
            text-decoration: none;
            margin-bottom: 20px;
            display: block; 
        }

        hr {
            border: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2); /* Garis pemisah samar */
            width: 100%;
            max-width: 400px; 
            margin: 20px 0 30px 0;
        }

        /* -- Register Container -- */
        .register-container {
            background-color: #2a2a2a; /* Background form sedikit lebih terang */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px; 
            text-align: center; 
        }

        .register-container h2 {
            font-size: 2em;
            margin-bottom: 30px;
            color: #fff;
        }

        /* -- Form Styling -- */
        .register-container form div {
            margin-bottom: 20px;
            text-align: left; 
        }

        .register-container label {
            display: block; 
            margin-bottom: 8px;
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.7);
            font-weight: bold;
        }

        .register-container input[type="text"],
        .register-container input[type="email"], /* TAMBAHAN EMAIL */
        .register-container input[type="password"] {
            width: 100%; 
            padding: 12px 10px;
            border: 1px solid #444; 
            background-color: #333; 
            color: #fff;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box; 
        }

        .register-container input:focus {
            border-color: #ffd500; /* Border kuning saat fokus */
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 213, 0, 0.3);
        }

        /* -- Button Styling -- */
        .register-container button[type="submit"] {
            background-color: #ffd500; /* Warna kuning tombol */
            color: #1a1a1a; 
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%; 
            margin-top: 10px;
        }

        .register-container button[type="submit"]:hover {
            background-color: #e0bb00; /* Warna kuning lebih gelap saat hover */
        }

        /* -- Error Messages -- */
        .register-container .error-message {
            color: #ff6b6b; /* Warna merah untuk pesan error */
            font-size: 0.85em;
            margin-top: 5px;
            display: block; 
            text-align: left;
        }

        /* -- Link Login -- */
        .register-container p {
            margin-top: 30px;
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.6);
        }

        .register-container p a {
            color: #ffd500; /* Warna kuning untuk link Login */
            text-decoration: none;
            font-weight: bold;
        }

        .register-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <a href="{{ route('home') }}" class="header-logo">
        MiFilms
    </a>

    <hr>

    <div class="register-container">
        <h2>Buat Akun Baru</h2>
        
        <form method="POST" action="{{ route('register.action') }}">
            @csrf

            <div>
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}">
                
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}">
                
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit">
                Register
            </button>
        </form>

        <p>
            Udah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>

</body>
</html>