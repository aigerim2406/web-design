<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function switchLang(Request $request, $lang){
        if (array_key_exists($lang,config('app.languages'))){  //massiv ishnde kiltishnde $lang  barma zhokpa izdeu
            $request->session()->put('myLocale',$lang);
        }
        return back();
    }
}
