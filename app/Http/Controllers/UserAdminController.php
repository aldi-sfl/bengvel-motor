<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
