<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;
use App\User;
use Auth;
use Image;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $fillable = [
        'name',
    ];

    public function update(Request $request){

        $attributes = request()->name;
        if($attributes!=null){
            $user = Auth::user();
            $user->name=$attributes;
            $user->save();
        }
        $attributes = request()->description;
        if($attributes!=null){
            $user = Auth::user();
            $user->description=$attributes;
            $user->save();
        }
        $attributes = request()->city;
        if($attributes!=null){
            $user = Auth::user();
            $user->city=$attributes;
            $user->save();
        }
        $attributes = request()->link;
        if($attributes!=null){
            $user = Auth::user();
            $user->link=$attributes;
            $user->save();
        }
        // Logic for user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        // Logic for user upload of avatar
        if($request->hasFile('banner')){
            $banner = $request->file('banner');
            $filename = time() . '.' . $banner->getClientOriginalExtension();
            Image::make($banner)->resize(1800, 600)->save( public_path('/uploads/banners/' . $filename ) );
            $user = Auth::user();
            $user->banner = $filename;
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

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('user.userProfile', ['user' => $user] );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user){

        if($user->id===Auth::user()->id) {
            return view('user.edit', ['user' => $user ]);
        }
        return redirect()->back();
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

        $result = DB::table('followers')
            ->where('follower_id', '=', Auth::user()->id)
            ->where('leader_id', '=', $user->id)
            ->exists();

        if ($result) {
            return redirect()->back()->with('error', 'User already followed.');
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
