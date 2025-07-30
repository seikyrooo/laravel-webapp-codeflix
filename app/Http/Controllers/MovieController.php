<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index() {

        $latestMovies = Movie::latest()->limit(8)->get();

        $popularMovies = Movie::with('ratings')
            ->get()
            ->sortByDesc('average_rating')
            ->take(8);

        return view('movies.index', [
            'latestMovies' => $latestMovies,
            'popularMovies' => $popularMovies,
        ]);
    }
}
