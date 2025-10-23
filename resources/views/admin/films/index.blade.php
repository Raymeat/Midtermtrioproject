<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Films</title>
    <style>
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
            width: 95%;
            max-width: 1400px;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #fff; /* Judul utama Putih */
            /* Margin bottom disetel agar spasi dengan tabel pas */
            margin-top: 0; 
            margin-bottom: 20px;
            text-align: left;
        }
        
        a {
            color: #ffd500;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        a:hover {
            color: #e0bb00;
        }

        /* --- HEADER DAN TOMBOL TAMBAH --- */
        .header-controls {
            display: flex;
            /* KUNCI: Pindahkan semua item ke KANAN */
            justify-content: flex-end; 
            align-items: center;
            width: 100%;
            /* Margin bottom dihilangkan dari sini, nanti diganti sama H1 */
            margin-bottom: 5px; 
            padding-top: 10px;
        }

        .back-link {
            font-size: 1em;
            font-weight: bold;
            padding: 8px 15px;
            border: 1px solid #ffd500;
            border-radius: 4px;
            background-color: #2a2a2a;
            color: #ffd500;
            /* KUNCI: Tambahkan margin kanan agar ada jarak ke tombol TAMBAH */
            margin-right: 15px; 
        }
        
        .back-link:hover {
            background-color: #ffd500;
            color: #1a1a1a;
        }

        .add-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffd500;
            color: #1a1a1a;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.2s, transform 0.1s;
        }

        .add-button:hover {
            background-color: #e0bb00;
            transform: translateY(-1px);
        }

        .film-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 0.95em;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            overflow: hidden;
        }

        .film-table thead tr {
            background-color: #2a2a2a; 
            color: #fff; 
        }

        .film-table th, .film-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        .film-table tbody tr {
            background-color: #1f1f1f;
            transition: background-color 0.2s;
        }

        .film-table tbody tr:hover {
            background-color: #2a2a2a;
        }
        
        .film-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* --- ACTION BUTTONS --- */
        .action-buttons a {
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            margin-right: 5px;
            background-color: #1a1a1a; 
            color: #fff; 
            border: 1px solid #444; 
        }
        
        .action-buttons a:hover {
            background-color: #2a2a2a; 
            color: #ffd500; 
        }

        .action-buttons button {
            background-color: #1a1a1a; 
            color: #ff6b6b; 
            border: 1px solid #ff6b6b; 
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .action-buttons button:hover {
            background-color: #ff6b6b; 
            color: #fff; 
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header-controls">
            <a href="{{ route('admin.dashboard') }}" class="back-link">Balik ke Dashboard</a>
            
            <a href="{{ route('admin.films.create') }}" class="add-button">
                + TAMBAH FILM BARU
            </a>
        </div>
        
        <h1>FILM</h1>

        <table class="film-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Link Trailer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($films->isEmpty())
                <tr>
                    <td colspan="5" style="text-align: center; color: #aaa;">Belum ada film di database, Cuk. Tambahin dulu!</td>
                </tr>
                @else
                    @foreach ($films as $film)
                        <tr>
                            <td>{{ $film->id }}</td>
                            <td>{{ $film->title }}</td>
                            <td>{{ Str::limit($film->description, 50) }}</td>
                            <td><a href="https://youtube.com/watch?v={{ $film->trailer_url }}" target="_blank">{{ $film->trailer_url }}</a></td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.films.edit', $film) }}">Edit</a>
                                
                                <form action="{{ route('admin.films.destroy', $film) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin mau hapus film {{ $film->title }}, Cuk?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
</body>
</html>