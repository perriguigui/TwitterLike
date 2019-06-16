
@extends('layout')
@section('content')
    <link rel="icon" type="image/png" href="image/icone.png" />
    <div>
        <div class=" search-block col-lg-4 col-md-5 col-sm-7 card mb-5  ">
            <form class="search-form  mb-3 py-3" style="   z-index: 99;"action="{{route('search')}}" method="get">
                <input type="text" name="search" class="ml-4 mr-3 mt-4   searchstyle-1"  placeholder="Search Username" value="{{ $search }}">
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
                <p class="d-inline color_black ml-2">Aucun utilisateurs trouvé!</p>
            @endif
            <h1 class="color_rouge col-2 mt-5 ">Post</h1>
            <div class="blog-post mx-auto mt-4 col d-inline">
                <h1 style="color: #D62C10">Mes tweets :</h1>
                @if(count($posts)>0)
                    @foreach ($posts as $post)
                        <div class=" card-style1 card p-4 py-4  mt-4 ">
                            <div class="post mx-3 post-css" data-postid="{{$post->id}}">
                                <a href="{{route("profile.show",$post->user->id)}}">
                                    <img src="/uploads/avatars/{{ $post->user->avatar }}" width="50px" height="50px" class="rounded-circle photo-style1 ">
                                </a>
                                <a href="{{route("profile.show",$post->user->id)}}" class=" col-3 profilename "> {{$post->user->name}}</a>
                                <h6 class="offset-1 date-style">{{$post->created_at}}</h6>
                                <p>{{$post->body}}</p>
                                <p class="d-inline color_rouge ml-2">{{$post->likes->where('like',1)->count()}}</p>
                                <div class="interaction my-3 color_rouge d-inline ">
                                    @if (Auth::check())
                                        <a href="" class="like fas fa-thumbs-down color_rouge ml-1">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==1 ? 'You dont like':'Dislike':'Dislike'}}</a>
                                        <a href="" class="like fas fa-thumbs-up color_rouge ml-1" >{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like==0 ? 'You like':'Like':'Like'}}</a>
                                    @else
                                        <p>faut se connecter pour liker</p>
                                    @endif
                                    <p class="d-inline color_rouge ml-2">{{$post->retweetsFromPost->count()}}</p>
                                    <i class=" fas fa-retweet ml-2"></i>
                                    <div class="dropdown">
                                        <a href="{{ route('retweet', ['user_id' => Auth::user()->id,'post_id' => $post->id]) }}" class="color_rouge ">Retweet</a>
                                        <div class="dropdown-content">
                                            <p style="color: #E11531;">Retweet by :</p>
                                            @foreach ($post->retweetsFromPost as $object)
                                                <p class="retweet_name-style "> {{ $object->user->name}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if(Auth::user()==$post->user)
                                        <a href="#" class="edit color_rouge ml-4">Edit</a>
                                        <a href="{{ route('post.delete', ['post_id' => $post->id]) }}" class="color_rouge">Delete</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            @endforeach
            @else
                <p class="d-inline color_black ml-2">Aucun posts trouvé!</p>
            @endif
        </ul>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-light btnstyle-1" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script src="{{asset('/js/like.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var token ='{{Session::token()}}';
        var urlLike = '{{route('like')}}';
        var urlEdit = '{{ route('edit') }}';
    </script>
@endsection