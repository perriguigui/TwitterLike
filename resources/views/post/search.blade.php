
@extends('layout')
@section('content')
    <link rel="icon" type="image/png" href="image/icone.png" />
    <div >
        <div class=" search-block col-lg-4 col-md-5 col-sm-7 card mb-5  ">
            <form class="search-form  mb-3 py-3" style="   z-index: 99;"action="{{route('search')}}" method="get">
                <input type="text" name="search" class="ml-4 mr-3 mt-4   searchstyle-1"  placeholder="Search Username" value="{{ $search }}">
                <button type="submit" class="btn-css"><i class="fas fa-search search-icon "></i></button>
            </form>
        </div>
        <ul id="users" >
            <h1 class="color_rouge  col-2 mb-4"  >Users</h1>
            @foreach($users as $user)
                <div class=" card card-style1 col-2 d-inline-block">
                 <li class="user-search-item"><a href="{{route('profile.show',$user->id)}}">{{$user->name}}</a></li>
                </div>
            @endforeach
                <h1 class="color_rouge col-2 mt-5 ">Post</h1>
            @foreach ($posts as $post)
                <div class=" card-style1 card mx-auto col-7  ">
                    <div>
                        <a href="#">
                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" width="50px" height="50px" class="rounded-circle photo-style1 ">
                        </a>
                        <a href="{{route("profile.show",$post->user->id)}}"class=" col-3 profilename "> {{$post->user->name}}</a>
                        <h6 class="offset-1 date-style">{{$post->created_at}}</h6>
                    </div>
                    <article class="post  mx-3 post-css" data-postid="{{$post->id}}">
                        <p>{{$post->body}}</p>
                        <p class="d-inline color_rouge">{{count($post->likes)}}</p>
                        <div class="interaction  my-3 d-inline">
                            @if (Auth::check())
                                <a href="" class="like fas fa-thumbs-down color_rouge ml-1">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? '  ':' ':'  '}}</a>
                                <a href="" class="like fas fa-thumbs-up color_rouge ml-3" >{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? '  ':'  ':'  '}}</a>
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