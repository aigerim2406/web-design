<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'image'=>'required|image|mimes:jpg,png,jpeg'
        ]);

        $fileName=time().$request->file('image')->getClientOriginalName();

        $image_path = $request->file('image')->storeAs('images',$fileName,'public');

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => Role::where('name', 'user')->first()->id,
            'image'=>'/storage/'.$image_path,
        ]);

        Auth::login($user);

        return redirect()->route('posts.index')->with('message', 'Autorization');
    }

    public function editregister(User $user){
        return view('posts.editprofile',['user' => $user]);
    }

    public function updateregister(Request $request,User $user){
        $request->validate([
            'image' => 'required|image',
            'email' => 'required',
            'name' => 'required'
        ]);
        $fileName = time().$request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('imagers',$fileName,'public');
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image'=>'/storage/'.$image_path,
        ]);
        return redirect()->route('post.user')->with('message','Sizdin profileniz ozgertildi');
    }
}
