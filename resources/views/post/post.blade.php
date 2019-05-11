@extends('layout')

@section('title','Twitter')

@section('content')

<div class="blog-header">
    <h2>Test Tweet</h2>
    <hr>
</div>
<div class="blog-post">
    @foreach ($posts as $post)
        <div class="post" data-postid="{{$post->id}}">
            <a href="#"><h3>{{$post->created_at}}</h3></a>
            <h6>Posted by {{$post->user->name}}</h6>

            <p>{{$post->body}}</p>
            <div class="interaction">
                @if (Auth::check())
                    <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You Like':'Like':'Like'}}</a>
                    <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You Dislike':'Dislike':'Dislike'}}</a>
                @else
                    <p>faut se connecter pour liker</p>
                @endif
            </div>
            @if(Auth::user()==$post->user)
                <a href="">Edit</a>
                <a href="">Delete</a>
             @endif

        </div>
    @endforeach
</div>

    <script src="{{asset('/js/like.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var token ='{{Session::token()}}';
        var urlLike = '{{route('like')}}';
    </script>

@endsection