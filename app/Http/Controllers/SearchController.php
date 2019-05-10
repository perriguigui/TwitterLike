<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
class SearchController extends Controller
{

    public function search()
    {
        $search = request('search');
        $users = User::where('name','like',"%{$search}%")->get();
        $posts = Post::where('body','like',"%{$search}%")->get();

        return view('post.search', compact('users','posts','search'));
    }
}
