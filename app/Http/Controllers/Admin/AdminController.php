<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function confirm(Cart $cart){
        $cart->update([
            'status' => 'confirmed'
        ]);
        return back();
    }

    public function cart(){
        $postsInCart = Cart::where('status', 'ordered')->with(['post','user'])->get();
        return view('admin.cart', ['postsInCart' => $postsInCart]);
    }

    public function showUsers(){
        return view('admin.users');
    }

    public function showPosts(){
        return view('admin.posts');
    }
}
