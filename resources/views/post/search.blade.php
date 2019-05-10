
@extends('layout')
@section('content')

    <div >
        <h2 class="section-title"><i data-feather="search"></i>Search</h2>
        <form class="search-form" action="{{route('search')}}" method="get">
            <input type="text" name="search" class="width-50" placeholder="Search for a user name/pseudo." value="{{ $search }}">
            <button type="submit" class="btn"><i data-feather="search">chercher</i></button>
        </form>
        <ul id="users" class="user-search-results">
            @foreach($users as $user)
                <li class="user-search-item"><a href="{{route('profile.show',$user->id)}}">{{$user->name}}</a></li>
            @endforeach
            @foreach($posts as $post)
                    <h2 class="user-search-item"><a href="{{route('profile.show',$user->id)}}">{{$post->user->name}}</a></h2>
                    <p>{{$post->body}}</p>
                @endforeach
        </ul>



    </div>
@endsection