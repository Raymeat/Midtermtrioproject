<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nonton: {{ $film->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; /* Background gelap */
            color: #fff; /* Teks putih */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px; 
            padding: 0 20px; 
            margin: 0 auto; 
        }

        /* --- HEADER TOP (Untuk link Dashboard dan Watchlist Button) --- */
        .header-top {
            width: 100%;
            max-width: 1200px;
            padding: 20px 20px 10px 20px;
            margin: 0 auto; 
            display: flex;
            justify-content: flex-end; /* Pindah ke KANAN */
            align-items: center; 
            gap: 15px; /* Jarak antar tombol */
        }

        .back-link {
            display: inline-block;
            color: #fff; 
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border: 1px solid #444;
            border-radius: 4px;
            transition: background-color 0.2s;
        }
        
        .back-link:hover {
            background-color: #333;
            color: #ffd500; /* Kuning saat hover */
        }

        hr {
            border: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 20px 0;
        }

        /* --- WATCHLIST BUTTONS DI HEADER (Styling Mirip Dashboard) --- */
        .header-top .watchlist-form {
            margin: 0;
            display: flex;
        }
        
        .header-top .watchlist-form button {
            background: none; 
            border: 1px solid #444;
            color: #fff;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }
        
        /* Styling tombol Simpan (kuning) */
        .header-top .watchlist-form button:not(:has(span.remove)) {
            border-color: #ffd500;
            color: #ffd500;
        }
        .header-top .watchlist-form button:not(:has(span.remove)):hover {
            background-color: #333;
            color: #ffd500;
        }

        /* Styling tombol Hapus (merah) */
        .header-top .watchlist-form button:has(span.remove) {
             border-color: #ff6b6b; 
             color: #ff6b6b; 
        }
        .header-top .watchlist-form button:has(span.remove):hover {
            background-color: #333;
            color: #ff6b6b;
        }
        
        /* --- INFO FILM (Judul, Deskripsi, Tombol) --- */
        .film-info {
            text-align: left;
            margin-bottom: 40px; 
            margin-top: -30px; /* Tarik ke atas */
        }

        .film-info h1 {
            font-size: 3em;
            color: #ffd500; 
            margin-bottom: 10px;
        }

        .film-info p {
            font-size: 1.2em;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 25px;
            line-height: 1.5;
            max-width: 800px;
        }

        /* --- TOMBOL WATCHLIST DI BAWAH INFO (JIKA DIKEMBALIKAN) --- */
        .film-info .watchlist-form button {
            background-color: #ffd500; 
            color: #1a1a1a;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .film-info .watchlist-form button:hover {
            background-color: #e0bb00;
        }

        .film-info .watchlist-form button:has(span.remove) {
             background-color: #ff6b6b; 
             color: #fff;
        }
        .film-info .watchlist-form button:has(span.remove):hover {
            background-color: #e65c5c;
        }

        /* --- TRAILER CONTAINER (Fixed Size & Cinematic) --- */
        .trailer-container {
            width: 100%;
            text-align: center; 
            margin-top: 20px; 
            margin-bottom: 50px; 
        }
        
        .trailer-container iframe {
            display: block; 
            margin: 0 auto; 
            width: 800px; 
            height: 450px; /* Ukuran fixed */
            border: 10px solid #2a2a2a; /* Frame tebal gelap */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Shadow halus */
            border-radius: 8px; /* Sudut melengkung */
        }

    </style>
</head>
<body>
    
    <div class="header-top">
        <form action="{{ route('user.films.watchlist', $film) }}" method="POST" class="watchlist-form">
            @csrf
            @if ($isInWatchlist)
                <button type="submit">Hapus dari Watchlist<span class="remove" style="display: none;"></span></button> 
            @else
                <button type="submit">+ Simpan ke Watchlist</button>
            @endif
        </form>
        
        <a href="{{ route('user.dashboard') }}" class="back-link">Dashboard</a>
    </div>

    <div class="container">
        
        <div class="film-info">
            <h1>{{ $film->title }}</h1>
            
            <p>{{ $film->description }}</p>

            <hr>
        </div>

        <div class="trailer-container">
            <iframe 
                src="https://www.youtube.com/embed/{{ $film->trailer_url }}" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>

    </div>

</body>
</html>