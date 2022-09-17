<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;

class GameController extends Controller
{
    public function index(Game $game, Category $category)
    {
        return view('games/checkbox')->with(['categories' => $category->get(), 'games' => $game->get()]);
    }
    
    public function create(Category $category)
    {
        return view('games/create')->with(['categories' => $category->get()]);
    }
    
    public function store(Request $request, Category $category)
    {
        $game = new Game();
        // dd($request);
        $game->name = $request->game_name;
        $game->category_id = $request->category_id;
        $game->save();
        return redirect('/games');
    }
    
}
