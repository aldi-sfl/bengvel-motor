<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function index()
    {
        $title =  'Profile - Orbit Motor';
        $avatar = session('avatar');
        $userId = Auth::id();
        $Users = User::findOrFail($userId);
        return view('pages.User.profile.profile_settings',[
            'avatar' => $avatar,
            'title' => $title,
            'users' => $Users
        ]);
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255'
        ]);

        $user = User::findOrFail($userId);

        $user->update([
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ]);


        toastr()->success('Profile updated successfully!', 'Success', ['timeOut' => 1000]);
        return redirect()->route('profile');
    }
}
