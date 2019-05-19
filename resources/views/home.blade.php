@extends('layout')

@section('content')
<div class="container">

    <section class="row new-post">
        <div class="col-md-6 col-sm-10 col-10 col-lg-6 mx-auto card">
            <div class="card-header cardHeaderStyle mx-auto px-5 mt-2 mb-5 border-bottom border-danger rounded"><h3>What do you have to say?</h3></div>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea style="resize: none" class="form-control" name="body" id="new-post" rows="5" placeholder="Your tweet with a limit of 140 caracters" maxlength="140"></textarea>
                </div>
                <button type="submit" class="btn btn-light btnstyle-1 mb-4">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>

    <div class="row justify-content-center my- mt-5">
        <div class="col-md-8">
            <div class="card">

                <form class="md-form mt-0 form-group searchstyle-1" action="{{route('search')}}" method="get">
                    <input type="text" name="search" class="ml-4  col-4 width-50 rounded-pill "  placeholder="Search for a user name/pseudo"value="{{ $search }}">
                    <button type="submit" class="btn btn-outline-danger "><i data-feather="search">chercher</i></button>
                </form>

               <!-- <div class="card-header">Dashboard</div>-->
                <div class="blog-post">
                    @if(count($posts)>0)
                    @foreach ($posts as $post)
                        <h3><a href="{{route("profile.show",$post->user->id)}}"class="ml-3 profilename"> {{$post->user->name}}</a></h3>
                        <h6>{{$post->created_at}}</h6>
                            <article class="post mx-3 post-css" data-postid="{{$post->id}}">
                                <p>{{$post->body}}</p>
                                <p>nb de like:{{count($post->likes)}}</p>
                                <div class="interaction searchstyle-2">

                                    @if (Auth::check())

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
                    @else
                        <h3>C'est ici que tu pourras suivre les tweets des personnes suivi. Mais pour cela il faut d'abord en suivre. Tu peux ainsi en rechercher dans la bar de recherche siyué ci-dessus</h3>
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
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
    </div>

</div>
@endsection
