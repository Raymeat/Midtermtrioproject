<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
</head>
<body>
    <a href="{{ route('user.dashboard') }}">&laquo; Balik ke Dashboard</a>

    <h1>Daftar Film yang Ada, Cuk</h1>
    <p>Silakan dipilih...</p>

    <hr>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        
        <!-- Kita looping semua film -->
        @foreach ($films as $film)
            <div style="border: 1px solid black; padding: 10px; width: 200px;">
                
                <!-- INI DIA THUMBNAIL-NYA, CUK! -->
                <!-- Kita panggil thumbnail dari YouTube pake ID trailer_url -->
                <a href="{{ route('user.films.show', $film) }}">
                    <img src="https://img.youtube.com/vi/{{ $film->trailer_url }}/hqdefault.jpg" alt="{{ $film->title }}" style="width: 100%;">
                </a>
                
                <h3>{{ $film->title }}</h3>
                <p>{{ Str::limit($film->description, 50) }}</p>

                <!-- Link buat nonton -->
                <a href="{{ route('user.films.show', $film) }}">Tonton Trailer</a>

                <hr style="margin: 10px 0;">

                <!-- Tombol Watchlist -->
                <form action="{{ route('user.films.watchlist', $film) }}" method="POST">
                    @csrf
                    <!-- Cek, ini film udah ada di watchlist belom? -->
                    @if (in_array($film->id, $watchlistIds))
                        <button type="submit" style="background-color: red; color: white;">Hapus dari Watchlist</button>
                    @else
                        <button type="submit" style="background-color: blue; color: white;">+ Tambah ke Watchlist</button>
                    @endif
                </form>
            </div>
        @endforeach

    </div>

</body>
</html>
