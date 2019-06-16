
@extends('layout')
@section('content')
    <link rel="icon" type="image/png" href="image/icone.png" />
    <div >
        <div class=" search-block col-lg-4 col-md-5 col-sm-7 card mb-5  ">
            <form class="search-form  mb-3 py-3" action="{{route('search')}}" method="get">
                <input type="text" name="search" class="ml-4 mr-3 mt-4   searchstyle-1" placeholder="Search Username" value="{{ $search }}">
                <button type="submit" class="btn-css"><i class="fas fa-search search-icon "></i></button>
            </form>
        </div>
        <ul id="users" >
            <h1 class="color_rouge  col-2 mb-4">Users</h1>
            @if(count($users)>0)
            @foreach($users as $user)
                <div class=" card card-style1 col-2 d-inline-block">
                 <li class="user-search-item"><a href="{{route('profile.show',$user->id)}}">{{$user->name}}</a></li>
                </div>
            @endforeach
            @else
                <p class="d-inline color_rouge ml-2">Aucun utilisateurs trouvé!</p>
            @endif
                <h1 class="color_rouge col-2 mt-5 ">Post</h1>
            @if(count($posts)>0)
            @foreach ($posts as $post)
                <div class=" card-style1 card mx-auto col-7  ">
                    <div>
                        <a href="#">
                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" width="50px" height="50px" class="rounded-circle photo-style1 ">
                        </a>
                        <a href="{{route("profile.show",$post->user->id)}}"class=" col-3 profilename "> {{$post->user->name}}</a>
                        <h6 class="offset-1 date-style">{{$post->created_at}}</h6>
                    </div>
                    @if (Auth::check())
                    <article class="post  mx-3 post-css" data-postid="{{$post->id}}">
                        <p>{{$post->body}}</p>
                        <p class="d-inline color_rouge">{{count($post->likes)}}</p>
                        <div class="interaction my-3 color_rouge d-inline">
                            <a href="" class="like fas fa-thumbs-down color_rouge ml-1">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You dont like':'Dislike':'Dislike'}}</a>
                            <a href="" class="like  fas fa-thumbs-up color_rouge ml-3" >{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You like':'Like':'Like'}}</a>

                            @else
                                <p>faut se connecter pour liker</p>
                            @endif
                            <p class="d-inline color_rouge ml-2">{{$post->retweetsCount->count()}}</p>
                            <a href="{{ route('retweet', ['user_id' => Auth::user()->id,'post_id' => $post->id]) }}" class="color_rouge">Retweet</a>
                            @if(Auth::user()==$post->user)
                                <a href="#" class="edit color_rouge ml-4">Edit</a>
                                <a href="{{ route('post.delete', ['post_id' => $post->id]) }}" class="color_rouge">Delete</a>
                            @endif
                            @foreach ($post->retweets as $object)
                                <p class="d-inline retweet_name-style "> Retweet by {{ $object->user->name }}</p>
                            @endforeach
                        </div>
                    </article>
                </div>
            @endforeach
            @else
                <p class="d-inline color_rouge ml-2">Aucun posts trouvé!</p>
            @endif
        </ul>
        </div>
    <script src="{{asset('/js/like.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var token ='{{Session::token()}}';
        var urlLike = '{{route('like')}}';
        var urlEdit = '{{ route('edit') }}';
    </script>
@endsection