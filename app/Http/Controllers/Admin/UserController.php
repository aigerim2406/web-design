<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request){
        $users = null;
        if($request->search){
            $users = User::where('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('email', 'LIKE', '%'.$request->search.'%')
            ->with('role')->get();
        }
        else{
            $users = User::with('role')->get();
        }
        return view('admin.users', ['users' => $users]);
    }

    public function shot(){
        return view('posts.shot');
    }

    public function addMoney(Request $request, User $user){
        $user->update([
            'shot' => Auth::user()->shot + $request->input('shot')
        ]);
        return redirect()->route('posts.index')->with('message','Added money');
    }
}
