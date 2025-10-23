<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <style>
        /* ==================================== */
        /* BASE STYLING (Dark Theme) */
        /* ==================================== */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; 
            color: #fff; 
            margin: 0;
            padding: 40px 0;
            display: flex;
            flex-direction: column;
            align-items: center; 
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 600px;
            padding: 30px;
            background-color: #2a2a2a; 
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            text-align: left;
        }

        /* --- JUDUL DAN SUBJUDUL --- */
        h1 {
            font-size: 2.5em;
            color: #ffd500; 
            margin-bottom: 5px;
        }
        
        h2 {
            font-size: 1.5em;
            color: #fff;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 1px solid #444;
            padding-bottom: 5px;
        }

        /* --- LINK KEMBALI --- */
        .back-link {
            display: inline-block;
            color: #fff; 
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 8px 15px;
            border: 1px solid #444;
            border-radius: 4px;
            transition: background-color 0.2s;
        }
        .back-link:hover {
            background-color: #333;
            color: #ffd500;
        }

        /* --- FORM STYLING --- */
        form div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffd500; /* Label warna kuning */
            font-size: 0.9em;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 10px;
            border: 1px solid #444;
            background-color: #1a1a1a; 
            color: #fff;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }
        
        input:focus {
            border-color: #ffd500;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 213, 0, 0.3);
        }

        /* --- BUTTON SIMPAN --- */
        button[type="submit"] {
            background-color: #ffd500;
            color: #1a1a1a;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #e0bb00;
            transform: translateY(-1px);
        }

    </style>
</head>
<body>
    
    <div class="container">
        <h2>Ubah Profil</h2>
        <form method="POST" action="{{ route('user.updateProfile') }}"> 
            @csrf
            
            <div>
                <label for="name">Nama :</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name ?? 'Nama User' }}">
            </div>
            
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email ?? 'email@contoh.com' }}">
            </div>

            <button type="submit">SIMPAN PROFIL</button>
        </form>
        
        <hr style="margin-top: 40px; margin-bottom: 40px;">

        <h2>Ubah Password</h2>
        <form method="POST" action="{{ route('user.updatePassword') }}"> 
            @csrf
            
            <div>
                <label for="current_password">Password Lama:</label>
                <input type="password" id="current_password" name="current_password">
            </div>
            
            <div>
                <label for="new_password">Password Baru:</label>
                <input type="password" id="new_password" name="new_password">
            </div>

            <div>
                <label for="new_password_confirmation">Konfirmasi Password Baru:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation">
            </div>

            <button type="submit">GANTI PASSWORD</button>
        </form>

    </div>

</body>
</html>