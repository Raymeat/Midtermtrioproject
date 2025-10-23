<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FilmController extends Controller
{

    public function index()
    {
        $films = Film::all();
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        return view('admin.films.create');
    }

    /**
     * Menyimpan film baru, menggunakan URL Eksternal untuk thumbnail.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'trailer_url' => 'required|string|min:11|max:11',
            // FIX: Validasi untuk input URL baru lu
            'thumbnail_url' => 'nullable|url|max:500', 
        ]);

        // 2. Mapping URL ke thumbnail_path
        $validatedData['thumbnail_path'] = $validatedData['thumbnail_url'] ?? null;
        
        // 3. Hapus key 'thumbnail_url' sebelum disimpan
        unset($validatedData['thumbnail_url']);
        
        // 4. Simpan ke Database (Hanya panggil satu kali)
        Film::create($validatedData); 

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan!');
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', compact('film'));
    }

    /**
     * Memperbarui data film yang sudah ada, menggunakan URL Eksternal untuk thumbnail.
     */
    public function update(Request $request, Film $film)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'trailer_url' => 'required|string|min:11|max:11',
            // FIX: Validasi untuk input URL baru lu
            'thumbnail_url' => 'nullable|url|max:500',
        ]);

        // 2. Mapping URL ke thumbnail_path
        $validatedData['thumbnail_path'] = $validatedData['thumbnail_url'] ?? null;
        
        // 3. Hapus key 'thumbnail_url' sebelum update
        unset($validatedData['thumbnail_url']);
        
        // 4. Simpan ke Database (Hanya panggil update satu kali)
        $film->update($validatedData);
        
        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui!');
    }

    /**
     * Menghapus film dan thumbnail (jika thumbnail_path adalah file lokal - walau sekarang URL).
     */
    public function destroy(Film $film)
    {
        // Catatan: Karena kita beralih ke URL eksternal, logic Storage::delete() 
        // dihilangkan untuk menghindari error, dan hanya menghapus record DB.
        
        $film->delete();

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus!');
    }

    public function listUserFilms(Request $request)
    {
        $films = Film::all();
        $watchlistIds = Auth::user()->films()->pluck('films.id')->toArray();
        return view('user.dashboard', compact('films', 'watchlistIds'));
    }


    public function showUser(Film $film)
    {
        $isInWatchlist = Auth::user()->films()->where('film_id', $film->id)->exists();
        return view('user.films.show', compact('film', 'isInWatchlist'));
    }

    public function handleWatchlist(Request $request, Film $film)
    {
        $user = Auth::user();

        $isAttached = $user->films()->where('film_id', $film->id)->exists();

        if ($isAttached) {
            $user->films()->detach($film);
            $message = 'Film dihapus dari Watchlist.';
        } else {
            $user->films()->attach($film);
            $message = 'Film berhasil ditambahkan ke Watchlist!';
        }

        return redirect()->back()->with('status', $message);
    }

    public function showWatchlist()
    {
        $films = Auth::user()->films;
        return view('user.films.watchlist', compact('films'));
    }
}