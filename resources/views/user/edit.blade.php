@extends('layout')
@section('content')

    <div class="container">
        <h2>{{ $user->name }}'s Profile</h2>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form enctype="multipart/form-data" action="{{ route('profile.update',$user) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <img src="/uploads/banners/{{ $user->banner }}" >
                    <label>Update Banner Image</label>
                    <input type="file" name="banner">

                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">


                    <h1 class="title" style="margin-top: 2em;">Edit name</h1>
                    <div class="field">
                        <label class="label" for="name">Username</label>
                        <div class="control">
                            <input type="text" class="input" name="name" required placeholder="Message" value="{{$user->name}}">
                        </div>
                    </div>

                    <h1 class="title" style="margin-top: 2em;">Edit City</h1>
                    <div class="field">
                        <label class="label" for="city">City</label>
                        <div class="control">
                            <input type="text" class="input" name="city" required placeholder="Message" value="{{$user->city}}">
                        </div>
                    </div>

                    <h1 class="title" style="margin-top: 2em;">Edit Link</h1>
                    <div class="field">
                        <label class="label" for="link">Link</label>
                        <div class="control">
                            <input type="text" class="input" name="link" required placeholder="Message" value="{{$user->link}}">
                        </div>
                    </div>

                    <h1 class="title" style="margin-top: 2em;">Edit Description</h1>
                    <div class="field">
                        <label class="label" for="description">Description</label>
                        <div class="control">
                            <input type="text" class="input" name="description" required placeholder="Message" value="{{$user->description}}">
                        </div>
                    </div>

                    <button type ="submit" class="button is-link">Update profile</button>
                </form>
            </div>
        </div>
    </div>
@endsection