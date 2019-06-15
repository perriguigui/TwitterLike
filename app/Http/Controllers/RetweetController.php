<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Retweet;

class RetweetController extends Controller
{
    public function retweet(Request $request)
    {
        $Retweets = new Retweet();
        $Retweets->user_id = $request['user_id'];
        $Retweets->post_id = $request['post_id'];
        $Retweets->retweet = 0;
        $Retweets->save();
        return redirect()->back();
    }
}
