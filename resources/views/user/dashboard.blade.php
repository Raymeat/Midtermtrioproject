<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | {{ Auth::user()->name }}</title>
    <style>
        /* ==================================== */
        /* BASE & THEME STYLING */
        /* ==================================== */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; 
            color: #fff; 
            margin: 0;
            padding: 0; 
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 1400px; 
            padding: 10px 20px 20px 20px; 
        }

        h1 {
            font-size: 2.5em;
            color: #fff;
            margin-top: 5px; 
            margin-bottom: 5px;
        }
        
        h2 {
            font-size: 1.8em;
            color: #ffd500; 
            margin: 30px 0 20px 0;
        }

        a {
            color: #ffd500;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        a:hover {
            color: #e0bb00;
        }

        hr {
            border: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 20px 0;
        }
        
        /* ==================================== */
        /* HEADER & NAVIGATION */
        /* ==================================== */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1400px;
            padding: 20px 20px 10px 20px; 
            box-sizing: border-box;
        }

        .header-top .logo a {
            font-size: 2em;
            font-weight: bold;
            color: #ffd500; 
        }
        
        .user-actions {
             display: flex;
             align-items: center;
             gap: 15px;
        }
        
        /* --- DROPDOWN PROFILE STYLING --- */
        .profile-dropdown { position: relative; display: inline-block; }
        .profile-button { background-color: #ffd500; color: #1a1a1a; border: none; padding: 8px 15px; border-radius: 4px; font-weight: bold; cursor: pointer; transition: background-color 0.2s; display: inline-flex; align-items: center; }
        .dropdown-content { display: none; position: absolute; right: 0; top: 100%; background-color: #2a2a2a; min-width: 160px; box-shadow: 0 8px 16px 0px rgba(0,0,0,0.5); z-index: 100; border-radius: 4px; overflow: hidden; margin-top: 5px; }
        .dropdown-content .username-display { color: #ffd500; padding: 12px 16px; font-weight: bold; border-bottom: 1px solid #333; pointer-events: none; }
        .dropdown-content a, .dropdown-content button { color: #fff; padding: 12px 16px; text-decoration: none; display: block; background: none; border: none; width: 100%; text-align: left; cursor: pointer; transition: background-color 0.2s; font-size: 1em; }
        .user-action-link { font-size: 1em; padding: 8px 15px; border: 1px solid #444; border-radius: 4px; color: #fff !important; opacity: 0.8; transition: opacity 0.2s, background-color 0.2s; text-transform: uppercase; }


        /* ==================================== */
        /* FILM GRID STYLING (FIX PANJANG VERTIKAL) */
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
        
        .film-item img {
            width: 100%;
            display: block;
            /* TINGGI THUMBNAIL (DIJAGA) */
            height: 300px; 
            object-fit: cover;
            border-bottom: 1px solid #444; 
        }
        
        .film-details {
            flex-grow: 1; 
            display: flex;
            flex-direction: column;
            
            padding: 5px 10px; 
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

        /* --- STYLING TOMBOL ACTION --- */
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
    
    <div class="header-top">
        <div class="logo">
             <a href="{{ route('home') }}">MiFilms</a>
        </div>
        
        <div class="user-actions">
            <a href="{{ route('user.films.showWatchlist') }}" class="user-action-link">MY WATCHLIST</a>
            
            <div class="profile-dropdown">
                
                <button onclick="toggleDropdown()" class="profile-button">
                    Profile
                    <span style="margin-left: 8px;">&#9660;</span> 
                </button>
                
                <div id="myDropdown" class="dropdown-content">
                    <div class="username-display">
                        {{ Auth::user()->name ?? 'User' }}
                    </div>
                    
                    <a href="{{ route('user.settings') }}">Settings</a>
                    
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <h1>Dashboard Film</h1>
        <p style="color: rgba(255, 255, 255, 0.7); margin-top: 5px;">Tempat semua video yang pernah lu lihat, atau yang lu pengen tonton. (Halo, {{ Auth::user()->name ?? 'User' }}!)</p>
        
        <hr> 

        <h2>Films</h2>

        <div class="film-grid">
            
            @if ($films->isEmpty())
                <p class="empty-message">Belom ada video, COK. Suruh admin nambahin dulu.</p>
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
                                    
                                    @if (in_array($film->id, $watchlistIds))
                                        <button type="submit">Hapus</button>
                                    @else
                                        <button type="submit">Simpan</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

<script>
    /* SCRIPT JAVASCRIPT UNTUK TOGGLE DROPDOWN */
    function toggleDropdown() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Tutup dropdown jika user klik di luar menu
    window.onclick = function(event) {
      if (!event.target.closest('.profile-button') && !event.target.closest('.dropdown-content')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    
    // Tambahkan class 'show' ke CSS untuk menampilkan dropdown
    document.addEventListener('DOMContentLoaded', function() {
        var style = document.createElement('style');
        style.type = 'text/css';
        style.innerHTML = '.dropdown-content.show { display: block; }';
        document.getElementsByTagName('head')[0].appendChild(style);
    });
</script>

</body>
</html>