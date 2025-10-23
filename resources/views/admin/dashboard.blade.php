<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; 
            color: #fff; 
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- HEADER TOP (Untuk Logout) --- */
        .header-top {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        
        /* --- LOGOUT BUTTON STYLING --- */
        .header-top button {
            background: none;
            border: 1px solid #ff6b6b; 
            color: #ff6b6b; 
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }

        .header-top button:hover {
            background-color: #ff6b6b;
            color: #fff;
        }


        /* --- MAIN CONTENT (Selamat Datang & Tombol) --- */
        .main-content {
            flex-grow: 1; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        /* --- JUDUL UTAMA --- */
        h1 {
            font-size: 3em;
            color: #ffd500; 
            /* KUNCI: Tambahkan margin bawah yang lebih besar dari sebelumnya */
            margin-bottom: 60px; 
        }
        
        p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1em;
            /* KUNCI: Margin bawah dari P ke tombol */
            margin-bottom: 70px; 
        }

        /* --- TOMBOL UTAMA (MANAGE FILMS) --- */
        .main-button {
            display: inline-block;
            padding: 20px 40px;
            background-color: #ffd500; 
            color: #1a1a1a; 
            font-size: 1.5em;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.2s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(255, 213, 0, 0.4);
            /* Margin atas ke elemen di atasnya (Paragraf) */
            margin-top: 0; 
        }

        .main-button:hover {
            background-color: #e0bb00;
            transform: translateY(-2px);
        }
        
    </style>
</head>
<body>
    
    <div class="header-top">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    
    <div class="main-content">
        <h1>Selamat Datang ADMIN GANTENG</h1>
         <a href="{{ route('admin.films.index') }}" class="main-button">
            MANAGE FILMS
        </a>
    </div>
    
</body>
</html>