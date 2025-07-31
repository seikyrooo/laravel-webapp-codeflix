<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Mod;

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
    public function show(Movie $movie) {
        $userPlan = Auth::user()->getCurrentPlan();
        $streamingUrl = $movie->getStreamingUrl($userPlan->resolution);

        return view('movies.show', [
            'movie' => $movie,
            'streamingUrl' => $streamingUrl
        ]);
    }
}
