<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function buy(User $user){
        $ids = Auth::user()->postsWithStatus('in_cart')->allRelatedIds();
        $itcart = Auth::user()->postsWithStatus('in_cart')->get();
        $sum = 0;
        foreach ($itcart as $itc) {
            $sum += $itc->price * $itc->pivot->quantity;
        }
        foreach ($ids as $id){
            Auth::user()->postsWithStatus('in_cart')->updateExistingPivot($id, ['status' => 'ordered']);
        }

        $user->update([
            'shot' => Auth::user()->shot-$sum
        ]);

        return back();
    }

    public function index(){
        $postsInCart = Auth::user()->postsWithStatus('in_cart')->get();
        $sum = 0;
        $kol = 0;

        foreach ($postsInCart as $its) {
            $sum += $its->price * $its->pivot->quantity;
            $kol += $its->pivot->kol;
        }
        return view('cart.index', ['postsInCart' => $postsInCart, 'kol' => $kol, 'sum' => $sum]);
    }

    public function putToCart(Request $request, Post $post){
        $postsInCart = Auth::user()->postsWithStatus('in_cart')->where('post_id', $post->id)->first();

        if($postsInCart != null){
            Auth::user()->postsWithStatus('in_cart')->updateExistingPivot($post->id,
            ['quantity' => $postsInCart->pivot->quantity+$request->input('quantity')]);
        }else{
            Auth::user()->postsWithStatus('in_cart')->attach($post->id,
                ['quantity' => $request->input('quantity')]);
        }
        return back();
    }

    public function deleteFromCart(Post $post){
        $postsBought = Auth::user()->postsWithStatus('in_cart')->where('post_id', $post->id)->first();

        if ($postsBought != null) {
            Auth::user()->postsWithStatus('in_cart')->detach($post->id);
        }
        return back();
    }
}
