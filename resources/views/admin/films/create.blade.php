<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film Baru</title>
    <style>
        /* Menggunakan style yang sama dengan edit.blade.php */
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

        h1 {
            font-size: 2em;
            color: #ffd500; 
            margin-bottom: 5px;
        }
        
        .trailer-note {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9em;
            margin-top: 0;
            margin-bottom: 20px;
        }

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
        
        .error-box {
            background-color: #3d1b1b;
            border: 1px solid #ff6b6b;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .error-box strong {
            color: #ff6b6b;
            display: block;
            margin-bottom: 10px;
        }
        .error-box ul {
            list-style: disc;
            margin: 0;
            padding-left: 20px;
            font-size: 0.9em;
        }
        
        hr {
            border: 0;
            border-top: 1px solid #444;
            margin: 20px 0;
        }

        form div { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #ffd500; font-size: 0.9em; }
        input[type="text"], input[type="url"], textarea {
            width: 100%; padding: 12px 10px; border: 1px solid #444; background-color: #1a1a1a; 
            color: #fff; border-radius: 4px; font-size: 1em; box-sizing: border-box; resize: vertical;
        }
        input:focus, textarea:focus { border-color: #ffd500; outline: none; box-shadow: 0 0 0 2px rgba(255, 213, 0, 0.3); }

        button[type="submit"] {
            background-color: #ffd500; color: #1a1a1a; border: none; padding: 12px 25px; border-radius: 5px;
            font-size: 1.1em; font-weight: bold; cursor: pointer; transition: background-color 0.2s, transform 0.1s;
            margin-top: 10px;
        }
        button[type="submit"]:hover { background-color: #e0bb00; transform: translateY(-1px); }
    </style>
</head>
<body>
    
    <div class="container">
        <a href="{{ route('admin.films.index') }}" class="back-link">Cancel</a>
        
        <h1>Form Tambah Film Baru</h1>
        <p class="trailer-note">Cukup masukin ID YouTube-nya aja, Cuk. (Misal: dQw4w9WgXcQ)</p>

        @if ($errors->any())
            <div class="error-box">
                <strong>Woi, Cuk, ada yang salah!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <hr>
        @endif

        <form action="{{ route('admin.films.store') }}" method="POST">
            @csrf 

            <div>
                <label for="title">Judul Film:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            
            <div>
                <label for="description">Deskripsi Singkat:</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="trailer_url">ID Trailer YouTube:</label>
                <input type="text" id="trailer_url" name="trailer_url" value="{{ old('trailer_url') }}" placeholder="Contoh: dQw4w9WgXcQ" required>
            </div>
            
            <hr>
            
            <div>
                <label for="thumbnail_url">Link/URL Poster Film (Opsional):</label>
                <input type="url" id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" placeholder="https://external.com/poster.jpg">
            </div>

            <button type="submit">SIMPAN FILM BARU</button>
        </form>
    </div>

</body>
</html>