@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="/uploads/banners/{{ $user->banner }}" style="width:900px; height:300px; float:left;">
                <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2>{{ $user->name }}'s Profile</h2>
                <h4>{{ $user->city }}</h4>
                <h4>{{ $user->link }}</h4>
                <h4>{{ $user->description }}</h4>
            </div>

        </div>
        <div class="edit">
            <a href="{{route("profile.edit",$user->id)}}">Editer</a>
        </div>
        <div class="blog-post">
            <a href="{{ route('user.follow', $user->id )}}">Follow User</a>
            <a href="{{ route('user.unfollow', $user->id )}}">Unollow User</a>
                @foreach ($user->posts as $post)
                    <div class="post" data-postid="{{$post->id}}">
                        <h3><a href="{{route("profile.show",$post->user->id)}}"> {{$post->user->name}}</a></h3>
                        <h6>{{$post->created_at}}</h6>

                        <p>{{$post->body}}</p>
                        <div class="interaction">
                            @if (Auth::check())
                                <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You Like':'Like':'Like'}}</a>
                                <a href="#" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You Dislike':'Dislike':'Dislike'}}</a>
                            @else
                                <p>faut se connecter pour liker</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <script src="{{asset('/js/like.js')}}" type="text/javascript"></script>
            <script type="text/javascript">
                var token ='{{Session::token()}}';
                var urlLike = '{{route('like')}}';
            </script>
        </div>

    @endsection