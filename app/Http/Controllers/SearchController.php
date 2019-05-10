<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
class SearchController extends Controller
{
    public function index()
    {
        $post = Post::with('user_id')->get();
        return view('home', compact('$post'));
    }
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Post::class, 'name')
            ->registerModel(User::class, 'body')
            ->perform($request->input('query'));

        return view('search', compact('searchResults'));
    }
}
