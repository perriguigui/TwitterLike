@extends('layout')

@section('content')

    <p class="big-name " >Actualité</p>

    <div class="row justify-content-center  mt-5 ">
        <div class="col-md-8 col-10 col-sm-12">
            <div class="search-block col-sm-8 col-12 col-10 col-lg-6 mx-auto mx-lg-auto card mb-3  ">
                <form class="search-form  mb-3 py-3"  action="{{route('search')}}" method="get">
                    <input type="text" name="search" class="ml-4 mr-3 mt-4   searchstyle-1 " placeholder=" Search Username " value="{{ $search }}">
                    <button type="submit" class="btn-css"><i class="fas fa-search search-icon "></i></button>
                </form>
            </div>
            <div class=" mx-auto card card-style1 border border-light ">
                <div class="cardHeaderStyle mx-auto px-5 mt-2 mb-5 border-bottom border-danger rounded text-center"><h3>What do you have to say?</h3></div>
                <form action="{{ route('post.create') }}" method="post">
                    <div class="form-group  mx-4">
                        <textarea style="resize: none " class="form-control " name="body" id="new-post" rows="4" placeholder="Your tweet with a limit of 140 caracters" maxlength="140"></textarea>
                    </div>
                    <button type="submit" class="btn btn-light btnstyle-1 mb-4 ml-4">Create Post</button>
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                </form>
            </div>
                <div class="blog-post mt-4 col d-inline">
                    @if(count($posts)>0)
                    @foreach ($posts as $post)
                        <div class=" card-style1 card p-4 py-4  mt-4 mx-auto col ">
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

                    @endforeach
                        @else
                            <h3 style="text-align: center;color:#343434;">C'est ici que tu pourras suivre les tweets des personnes suivi. Mais pour cela il faut d'abord en suivre. Tu peux ainsi en rechercher dans la bar de recherche situé ci-dessus</h3>
                        @endif
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
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-light btnstyle-1" id="modal-save">Save changes</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <script src="{{asset('/js/like.js')}}" type="text/javascript"></script>
                <script src="{{asset('/js/retweet.js')}}" type="text/javascript"></script>
                <script type="text/javascript">
                    var token ='{{Session::token()}}';
                    var urlLike = '{{route('like')}}';
                    var urlEdit = '{{ route('edit') }}';
                </script>



            </div>
        </div>
    </div>

@endsection
