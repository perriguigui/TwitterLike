<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;
use App\User;
use Auth;
use Image;

class UserController extends Controller
{
    protected $fillable = [
        'name',
    ];

    public function update(Request $request){
        // Logic for user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('user.userProfile', ['user' => Auth::user()] );
    }

    /**
     * Show the user details page.
     * @param int $userId
     *
     */
    public function showfollow(int $userId)
    {
        $user = User::find($userId);
        $followers = $user->followers;
        $followings = $user->followings;

        return view('user.show', compact('user', 'followers' , 'followings'));
    }
    public function show(User $user)
    {

        return view('user.userProfile', ['user' => $user] );
    }
    public function edit(){

        return view('user.userProfileEdit', ['user' => Auth::user() ]);
    }
    /**
     * Follow the user.
     *
     * @param $profileId
     *
     */
    public function followUser(int $profileId)
    {

        $user = User::find($profileId);
        if(! $user) {
            return redirect()->back()->with('error', 'User does not exist.');
        }

        $user->followers()->attach(auth()->user()->id);

        return redirect()->back()->with('success', 'Successfully followed the user.');

    }

    /**
     * unFollow the user.
     *
     * @param $profileId
     *
     */
    public function unFollowUser(int $profileId)
    {
        $user = User::find($profileId);
        if(! $user) {

            return redirect()->back()->with('error', 'User does not exist.');
        }

        $user->followers()->detach(auth()->user()->id);

        return redirect()->back()->with('success', 'Successfully unfollowed the user.');

    }

}
