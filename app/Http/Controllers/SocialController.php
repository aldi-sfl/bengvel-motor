<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();    
    }

    public function googleCallback () 
    {

        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            // Handle the case where the user cancels or the authentication fails
            return redirect()->route('home')->with('error', 'Google authentication failed.');
        }

    // Retrieve user data from Google
    $socialUser = Socialite::driver('google')->user();
    $nama = $socialUser->getName();
    $email = $socialUser->getEmail();
    $avatar = $socialUser->getAvatar();
    $registeredUser = User::where("google_id", $socialUser->id)->first();
    
    if(!$registeredUser){
        $user = User::UpdateOrCreate([
            'google_id' => $socialUser->id,
            'email' => $socialUser->email,
        ],[
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'password' => Hash::make('1123'),
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
            
        ]);

        Auth::login($user);
        session()->put('avatar', $avatar);
        return view('auth.googleRegister')->with([
            'nama' => $nama,
            'email' => $email,
            'avatar' => $avatar
        ]);
        
    }else
    Auth::login($registeredUser);
    session()->put('avatar', $avatar);
    return redirect('/home');
    
    }

    public function AddPhone(Request $request) 
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        User::where('google_id', $user->google_id)->update($validatedData);
        return redirect('/home');

    }

  


   
}
