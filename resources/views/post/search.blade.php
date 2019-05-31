
@extends('layout')
@section('content')
    <link rel="icon" type="image/png" href="image/icone.png" />
    <div >
        <h2 class="section-title"><i data-feather="search"></i>Search</h2>
        <div class="search-block col-sm-8 col-10 col-lg-5  card mb-3  ">
            <form class="search-form  mb-3 py-3" action="{{route('search')}}" method="get">
                <input type="text" name="search" class="ml-4 mr-3 mt-4   searchstyle-1" placeholder="Search for a user name/pseudo." value="{{ $search }}">
                <button type="submit" class="btn-css"><i class="fas fa-search search-icon "></i></button>
            </form>
        </div>
        <ul id="users" class="user-search-results">
            <h1>User</h1>
            @foreach($users as $user)
                <div class=" card-style1 card col-2  ">
                 <li class="user-search-item"><a href="{{route('profile.show',$user->id)}}">{{$user->name}}</a></li>
                </div>
            @endforeach
                <h1>Post</h1>
            @foreach ($posts as $post)
                <div class=" card-style1 card mx-auto  ">
                    <div>
                        <a href="#">
                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" width="35px" height="35px" class="rounded-circle photo-style1 ">
                        </a>
                        <a href="{{route("profile.show",$post->user->id)}}"class=" col-3 profilename "> {{$post->user->name}}</a>
                        <h6 class="offset-1 date-style">{{$post->created_at}}</h6>
                    </div>
                    <article class="post  mx-3 post-css" data-postid="{{$post->id}}">
                        <p>{{$post->body}}</p>
                        <div class="interaction  my-3">
                            @if (Auth::check())
                                <p>nb de like:{{count($post->likes)}}</p>
                                <a href="" class="like fas fa-thumbs-up">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You Like':'Like':'Like'}}</a>
                                <a href="" class="like fas fa-thumbs-down">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You Dislike':'Dislike':'Dislike'}}</a>
                            @else
                                <p>faut se connecter pour liker</p>
                            @endif

                            @if(Auth::user()==$post->user)
                                <a href="#" class="edit">Edit</a>
                                <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                            @endif
                        </div>
                    </article>
                </div>
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