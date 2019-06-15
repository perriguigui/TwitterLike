@extends('layout')
@section('content')

    <p class="big-name " >Edit</p>
    <div class="container">
        <h2>{{ $user->name }}'s Profile</h2>

        <div class="row">
            <div class="col-md-10 col-md-offset-1 card card-style1 p-5">
                <form enctype="multipart/form-data" action="{{ route('profile.update',$user) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <img src="/uploads/banners/{{ $user->banner }}" >
                    <label>Update Banner Image</label>
                    <input type="file" name="banner" class="btn btn-light btnstyle-1 offset-4 width_filebutton">

                    <label class="d-inline">Update Profile Image</label>
                    <img src="/uploads/avatars/{{ $user->avatar }}"class="avatar_upload">
                    <input class="d-inline btn btn-light btnstyle-1 width_filebutton" type="file" name="avatar">


                    <div class="mx-auto ">
                            <div class="edit_div1">
                                <p class="titre_style1" >Edit username</p>
                                <div class="control ">
                                    <input type="text" class="input" name="name" required placeholder="Message" value="{{$user->name}}">
                                </div>
                            </div>


                        <div class="edit_div1">
                            <!--<label class="label" for="city">City</label>-->
                            <p class="titre_style1" >Edit City</p>
                            <div class="control">
                                <input type="text" class="input" name="city" required placeholder="Message" value="{{$user->city}}">
                            </div>
                        </div>


                        <div class="edit_div1">
                            <p class="titre_style1" >Edit Link</p>
                           <!-- <label class="label" for="link">Link</label>-->
                            <div class="control">
                                <input type="text" class="input" name="link" required placeholder="Message" value="{{$user->link}}">
                            </div>
                        </div>


                        <div class="edit_div1">
                            <p class="titre_style1" >Edit Description</p>
                            <!--<label class="label" for="description">Description</label>-->
                            <div class="control">
                                <input type="text" class="input" name="description" required placeholder="Message" value="{{$user->description}}">
                            </div>
                        </div>
                   </div>
                    <button type ="submit" class="btn btn-light btnstyle-1 mt-5 mb-5">Update profile</button>
                </form>
            </div>
        </div>
    </div>
@endsection