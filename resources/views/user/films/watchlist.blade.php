<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist</title>
    <style>
        /* ==================================== */
        /* BASE & THEME STYLING */
        /* ==================================== */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; /* Background gelap */
            color: #fff; /* Teks putih */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 1400px; 
            padding: 0 20px; 
        }

        /* --- HEADER TOP (MiFilms Kiri, Dashboard Kanan) --- */
        .full-header-top {
            width: 100%;
            padding: 20px 20px 10px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .full-header-top .logo a {
            font-size: 2em;
            font-weight: bold;
            color: #ffd500; /* Warna MiFilms */
            text-decoration: none;
        }
        
        /* -- Link Dashboard (Di Kanan Atas) -- */
        .header-dashboard-link {
            display: inline-block; 
            padding: 8px 15px; 
            border: 1px solid #444; /* Border sedikit terlihat */
            border-radius: 4px; 
            background-color: #2a2a2a; 
            font-size: 1em; 
            font-weight: bold;
            color: #fff; /* Teks Putih */
            transition: all 0.2s;
        }
        
        .header-dashboard-link:hover {
            background-color: #333;
            color: #ffd500; 
            border-color: #ffd500;
        }


        /* --- JUDUL KONTEN DI BAWAH HEADER --- */
        h1 {
            font-size: 2.5em;
            color: #fff;
            margin-top: 10px; 
            margin-bottom: 5px;
        }
        
        h2 {
            font-size: 1.8em;
            color: #ffd500; /* Judul section kuning */
            margin: 30px 0 20px 0;
        }

        /* --- LINK DEFAULT --- */
        a { color: #ffd500; text-decoration: none; transition: color 0.2s; }
        a:hover { color: #e0bb00; }
        hr { border: 0; border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 20px 0; }
        
        /* ==================================== */
        /* FILM GRID STYLING (SINKRONISASI) */
        /* ==================================== */
        .film-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); 
            gap: 20px;
            width: 100%;
            margin-top: 15px;
        }
        
        .film-item {
            background-color: #2a2a2a; 
            border-radius: 8px;
            overflow: hidden; 
            border: 2px solid #333; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s, border-color 0.2s;
            display: flex;
            flex-direction: column;
        }
        
        .film-item:hover {
            transform: translateY(-5px); 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
            border-color: #ffd500;
        }
        
        /* Style buat thumbnail gambar */
        .film-item img {
            width: 100%;
            display: block;
            height: 300px; /* Tinggi thumbnail fixed */
            object-fit: cover; 
            border-bottom: 1px solid #444; 
        }
        
        /* Detail dan Tombol di Bawah Gambar */
        .film-details {
            flex-grow: 1; 
            display: flex;
            flex-direction: column;
            
            padding: 5px 10px; 
            padding-bottom: 0;
            text-align: center;
        }

        .film-details h3 {
            margin: 2px 0 5px 0;
            font-size: 1.1em;
            color: #fff;
            text-align: left;
            line-height: 1.2;
        }
        
        .film-details .action-links {
            margin-top: auto; 

            display: flex;
            justify-content: flex-start;
            gap: 10px; 
            align-items: center;
            margin-bottom: 5px; 
        }

        /* --- STYLING TOMBOL ACTION (SINKRONISASI) --- */
        .film-details .action-links a {
            background-color: #1a1a1a; 
            color: #ffd500;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
            border: 1px solid #ffd500; /* Tombol Details (Kuning Outline) */
        }
        .film-details .action-links a:hover {
            background-color: #ffd500;
            color: #1a1a1a;
        }
        
        .film-details .action-links button {
            color: #1a1a1a;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.2s;
            border: 1px solid #ffd500; 
        }
        
        .film-details .action-links button[type="submit"] {
             background-color: #ffd500; /* Tombol Simpan (Kuning Penuh) */
             color: #1a1a1a;
             border-color: #ffd500;
        }
        
        .film-details .action-links form button[type="submit"] {
            background-color: #ff6b6b; /* Tombol Hapus (Merah Penuh) */
            color: #fff;
            border-color: #ff6b6b;
        }
        /* ==================================== */
        /* MESSAGE STYLING */
        /* ==================================== */
        .empty-message {
            color: rgba(255, 255, 255, 0.6);
            margin-top: 20px;
            font-size: 1.1em;
            text-align: center;
            width: 100%;
        }

    </style>
</head>
<body>
    
    <div class="full-header-top">
        <div class="logo">
            <a href="{{ route('home') }}">MiFilms</a>
        </div>
        
        <a href="{{ route('user.dashboard') }}" class="header-dashboard-link">Dashboard</a>
    </div>

    <div class="container">
        
        <h1>My Watchlist</h1>

        <hr>

        <h2>Video Tersimpan</h2>

        <div class="film-grid">
            
            @if ($films->isEmpty())
                <p class="empty-message">Lu ga ada watchlist pak. Kosong melompong!</p>
            @else
                @foreach ($films as $film)
                    <div class="film-item">
                        
                        <a href="{{ route('user.films.show', $film) }}">
                            @if($film->thumbnail_path)
                                <img src="{{ $film->thumbnail_path }}" alt="{{ $film->title }} Poster">
                            @else
                                <img src="https://img.youtube.com/vi/{{ $film->trailer_url }}/hqdefault.jpg" alt="{{ $film->title }}">
                            @endif
                        </a>
                        
                        <div class="film-details">
                            <h3>{{ $film->title }}</h3>

                            <div class="action-links">
                                <a href="{{ route('user.films.show', $film) }}">Details</a>

                                <form action="{{ route('user.films.watchlist', $film) }}" method="POST">
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

</body>
</html>