<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller implements HasMiddleware
{
  public static function middleware()
  {
    return ['auth', 'check.device.limit'];
  }

  public function index()
  {
    // cek middleware, auth, device limit, dan middleware subscribe
    if (!Auth::check()) {
      return redirect()->route('login');
    }
    $latestMovies = Movie::latest()->limit(8)->get();
    $popularMovies = Movie::with('ratings')
      ->get()->sortByDesc('average_rating')
      ->take(8);

    return view('movies.index', [
      'latestMovies' => $latestMovies,
      'popularMovies' => $popularMovies
    ]);
  }

  public function show(Movie $movie)
  {
    $userPlan = Auth::user()->getCurrentPlan();
    if (!$userPlan) {
      return redirect()->route('subscribe.plans');
    }
    $streamingUrl = $movie->getStreamingUrl($userPlan->resolution);
    return view('movies.show', [
      'movie' => $movie,
      'streamingUrl' => $streamingUrl
    ]);
  }

  public function search(Request $request)
  {
    $search = $request->input('q');
    $movies = Movie::where('title', 'like', "%$search%")->get();
    return view('movies.search', [
      'keyword' => $search,
      'movies' => $movies
    ]);
  }

  public function all(Request $request)
  {
    $movies = Movie::orderBy('release_date', 'desc')->paginate(8);
    if ($request->ajax()) {
      $html = view('components.movie-list', compact('movies'))->render();
      return response()->json(['html' => $html, 'next_page' => $movies->nextPageUrl()]);
    }
    return view('movies.all', compact('movies'));
  }
}
