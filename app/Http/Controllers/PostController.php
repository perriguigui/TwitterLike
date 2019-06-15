<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Like;
use App\Retweet;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{

    public function index(){
        $search = request('search');
        $id = Auth::id();
        $posts = Post::whereIn('user_id', function($query) use($id)
        {
            $query->select('leader_id')
                ->from('followers')
                ->where('follower_id', $id)->latest();
        })->orWhere('user_id', $id)->latest()->get();

        $retweets = Retweet::whereIn('user_id', function($query) use($id)
        {
            $query->select('leader_id')
                ->from('followers')
                ->where('follower_id', $id)->latest();
        })->orWhere('user_id', $id)->latest()->get();

        foreach ($retweets as $retweet){
            $postfromretweet = $retweet->post;
            $merged = $posts->add($postfromretweet);
        }



        return view('home',compact('merged','search'));
    }

    public function likePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike']==='true';
        $update = false;
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id',$post->id)->first();
        if($like){
            $already_like=$like->like;
            $update = true;
            if($already_like == $is_like){
                $like->delete();
                return null;
            }
        }else{
            $like = new like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;

        if($update){
            $like->update();
        }else{
            $like->save();
        }
        return null;
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:140'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('home')->with(['message' => $message]);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('home')->with(['message' => 'Successfully deleted!']);
    }

}
