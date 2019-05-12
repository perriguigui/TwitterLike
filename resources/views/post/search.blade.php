
@extends('layout')
@section('content')

    <div >
        <h2 class="section-title"><i data-feather="search"></i>Search</h2>
        <form class="search-form" action="{{route('search')}}" method="get">
            <input type="text" name="search" class="width-50" placeholder="Search for a user name/pseudo." value="{{ $search }}">
            <button type="submit" class="btn"><i data-feather="search">chercher</i></button>
        </form>
        <ul id="users" class="user-search-results">
            <h1>User</h1>
            @foreach($users as $user)
                <li class="user-search-item"><a href="{{route('profile.show',$user->id)}}">{{$user->name}}</a></li>
            @endforeach
                <h1>Post</h1>
            @foreach ($posts as $post)
                <h3><a href="{{route("profile.show",$post->user->id)}}"> {{$post->user->name}}</a></h3>
                <h6>{{$post->created_at}}</h6>
                <article class="post" data-postid="{{$post->id}}">
                    <p>{{$post->body}}</p>
                    <div class="interaction">
                        @if (Auth::check())
                            <p>nb de like:{{count($post->likes)}}</p>
                            <a href="" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You Like':'Like':'Like'}}</a>
                            <a href="" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You Dislike':'Dislike':'Dislike'}}</a>
                        @else
                            <p>faut se connecter pour liker</p>
                        @endif

                        @if(Auth::user()==$post->user)
                            <a href="#" class="edit">Edit</a>
                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </ul>
        </div>
    <script src="{{asset('/js/like.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var token ='{{Session::token()}}';
        var urlLike = '{{route('like')}}';
        var urlEdit = '{{ route('edit') }}';
    </script>
@endsection