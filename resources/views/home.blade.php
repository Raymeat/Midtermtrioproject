<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Film Keren | MiFilms</title>

    <style>
        /* ==================================== */
        /* CSS HOME PAGE LETTERBOXD STYLE (INTERNAL) */
        /* ==================================== */
        
        /* -- Global Reset dan Base Style -- */
        body {
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; /* Backup warna gelap jika gambar gagal */
        }

        /* --- HERO SECTION (Background Image & Overlay) --- */
        main {
            flex-grow: 1;
            display: flex;
            /* Posisikan konten di tengah */
            align-items: center; 
            justify-content: center;
            padding-bottom: 50px;

            /* KUNCI: BACKGROUND IMAGE SETTINGS */
            background-image: 
                /* LAPISAN 1: Overlay hitam transparan */ 
                linear-gradient(
                    rgba(0, 0, 0, 0.7),
                    rgba(0, 0, 0, 0.8)
                ),

            background-size: cover;
            background-position: center;
        }

        /* --- Teks Hero (Simpen semua memori...) --- */
        main .hero-content {
            max-width: 800px;
            text-align: center;
            z-index: 10;
        }

        /* Mengatur ukuran dan gaya teks hero */
        .hero-content h1, 
        .hero-content h2, 
        .hero-content p {
            /* Gaya Teks Utama agar tebal dan besar */
            font-weight: 700;
            line-height: 1.2;
            margin: 15px 0;
            /* Ukuran font disamakan agar mirip gambar */
            font-size: 2.5em; 
        }

        .hero-content p {
            margin-bottom: 40px; /* Jarak ke tombol */
        }

        /* --- Header/Navigasi (Logo Kiri, Link Kanan) --- */
        header {
            width: 100%;
            padding: 20px 0;
            text-align: left;
            z-index: 20;
            position: relative;
        }

        nav {
            display: flex;
            justify-content: space-between; 
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Link Mifilms (Logo) */
        nav a:first-child {
            font-size: 1.8em;
            font-weight: bold;
            color: #ffd500; /* Warna logo hijau */
            text-decoration: none;
        }

        /* Link Login/Register */
        .auth-links a,
        .auth-links button {
            color: #fff;
            text-decoration: none;
            margin-left: 15px;
            font-size: 1em;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        /* Style Tambahan untuk Link Navigasi */
        .auth-links a {
            padding: 5px 0;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        .auth-links a:hover {
            opacity: 1;
        }


        /* --- Tombol Hero Hijau (Get Started) --- */
        .hero-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #ffd500; /* Warna hijau khas Letterboxd */
            color: #000;
            font-weight: bold;
            font-size: 1.1em;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .hero-button:hover {
            background-color: #ffd500;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">
                MiFilms
            </a>
            
            <div class="auth-links">
                
                @guest('web')
                    @guest('admin')
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}">
                        Register
                    </a>
                    @endguest
                @endguest

                @auth('web')
                    <a href="{{ route('user.dashboard') }}">Dashboard User</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth

                @auth('admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth

            </div>
        </nav>
    </header>

    <main>
        <div class="hero-content">
            
            <h1>
                Track films you’ve watched
            </h1>
            <h1>
                Save those you want to see.

            </h1>
            <h1>
                Tell your friends what’s good.
            </h1>            
            <a href="{{ route('register') }}" class="hero-button">
                Get started
            </a>
            
        </div>
    </main>

</body>
</html>