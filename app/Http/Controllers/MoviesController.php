<?php

namespace App\Http\Controllers;

use App\Models\MGenres;
use App\Models\MMovies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Before
        // $books = Book::all();
        // After
        $movies = MMovies::with('genre')->get();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = MGenres::all();
        return view('movies.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:1000',
            'poster' => 'required|string|max:255',
            'year' => 'required|string|max:8',
            'available' => 'required|boolean|default:1',
            'genre_id' => 'required|exists:m_genres,id',

        ]);
        MMovies::create([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'poster' => $validated['poster'],
            'year' => $validated['year'],
            'available' => $validated['available'],
            'genre_id' => $validated['genre_id'],
        ]);
        return redirect()->route('movies.index')->with('success', 'Movie has been successfully created!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = MMovies::findOrFail($id);
        $genres = MGenres::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**
         * Buat code untuk validasi inputan user
         */

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:1000',
            'poster' => 'required|string|max:255',
            'year' => 'required|string|max:8',
            'available' => 'required|boolean|default:1',
        ]);

        /**
         * Ambil buku sesuai dengan id yang dikirim / lalu update berdasarkan perubahan yang dikirimkan user
         */
        $movie = MMovies::findOrFail($id);

        $movie->update([
            'title' => $validated['title'],
            'genre_id' => $validated['genre_id'],
            'synopsis' => $validated['synopsis'],
            'poster' => $validated['poster'],
            'year' => $validated['year'],
            'available' => $validated['available'],
            'image' => 'https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg'
        ]);

        /**
         * Kembalikan user ke halaman list books
         */
        return redirect()->route('movies.index')->with('success', 'Book has been successfully updated!');
    }

    public function __construct()
    {
       $this->middleware(['auth'])->except(['index', 'show']);
       $this->middleware(['auth', 'isAdmin'])->only(['edit', 'update', 'destroy']);
       $this->authorize('isAdmin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = MMovies::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Book has been successfully deleted!');
    }
}
