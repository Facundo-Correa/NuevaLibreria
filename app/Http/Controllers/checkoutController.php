<?php

namespace App\Http\Controllers;

use App\carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class checkoutController extends Controller
{
    //

    function checkLogin() {
        /*if($user = Auth::user()){
            $id = $user->id;
            $this->synchronyze($id);
        }
        else {
            $checkout = true;
            return view('pages::public.login', compact('checkout'));
        }*/

        
        return view('pages::public.checkout');
    }

    public function synchronyze($id) {
        // || Emparejar con carrito por sesion
        $carrito = carrito::where('SessionID', Session::getId())->first();

        if($carrito == null && isset(Auth::user()->id)){

            $carrito = carrito::where('UserId', Auth::user()->id)->first();
        }

        // Si el carrito no se encuentra, crearlo
        if($carrito == null){
            $carrito = new carrito();
            $carrito->SessionID = Session::getId();
            $carrito->UserId = $id;
            $carrito->Cart = '[]';
            $carrito->save();
        }

        // Update Id
        $carrito->UserId = $id;
        $carrito->save();
    }
}
