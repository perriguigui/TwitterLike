@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form class="search-form" action="{{route('search')}}" method="get">
                    <input type="text" name="search" class="width-50" placeholder="Search for a user name/pseudo." value="{{ $search }}">
                    <button type="submit" class="btn"><i data-feather="search">chercher</i></button>
                </form>
                <div class="card-header">Dashboard</div>
                <div class="blog-post">
                    @foreach ($posts as $post)
                        <div class="post" data-postid="{{$post->id}}">
                            <h3><a href="{{route("profile.show",$post->user->id)}}"> {{$post->user->name}}</a></h3>
                            <h6>{{$post->created_at}}</h6>

                            <p>{{$post->body}}</p>
                            <div class="interaction">
                                @if (Auth::check())
                                    <a href="" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You Like':'Like':'Like'}}</a>
                                    <a href="" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You Dislike':'Dislike':'Dislike'}}</a>
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
            </div>
        </div>
    </div>

</div>
@endsection
