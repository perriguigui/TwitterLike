@extends('layout')
@section('content')

    <div class="container">
        <h2>{{ $user->name }}'s Profile</h2>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <h1 class="title" style="margin-top: 2em;">Edit name</h1>
                    <div class="field">
                        <label class="label" for="name">Username</label>
                        <div class="control">
                            <input type="text" class="input" name="name" required placeholder="Message" value="{{$user->name}}">
                        </div>
                    </div>
                    
                    <div class="field">
                        <div class="control">
                            <button type ="submit" class="button is-link">Update profile</button>
                        </div>
                    </div>



                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="submit" class="pull-right button is-link">
                </form>
            </div>
        </div>
    </div>
@endsection