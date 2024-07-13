<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('query');

         if ($query) {
            $users = User::where('name', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%")
                ->get();
        } else {
            $users = User::all();
        }
        return view('pages.admin.user',[
            'users' => $users,
            'query' => $query
        ]);
    }

    public function addUser() 
    {
        return view('pages.admin.addUser');
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);

        toastr()->success('add user successfully!', 'Success', ['timeOut' => 1000]);
        return redirect(route('user-admin'));
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Ensure that the currently logged-in user cannot delete themselves
        if ($user->id === auth()->user()->id) {
            toastr()->error('You cannot delete your own account!', 'Error', ['timeOut' => 1000]);
            return redirect()->back();
        }

        $user->delete();

        toastr()->success('User deleted successfully!', 'Success', ['timeOut' => 1000]);
        return redirect()->back();
    }
}
