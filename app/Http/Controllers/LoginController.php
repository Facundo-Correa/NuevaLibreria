<?php

namespace App\Http\Controllers;

use App\carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use TypiCMS\Modules\Users\Models\User;

class LoginController extends Controller
{
    function verify(Request $request) {
        $credenciales = $request->only('email', 'password');

        // || Email vacio.
        if($credenciales['email'] == ""){
            return redirect('/es/iniciar-sesion')->with('message', 'Debe ingresar su email.');
        }

        // || Password vacio.
        else if($credenciales['password'] == "") {
            return redirect('/es/iniciar-sesion')->with('message', 'Debe ingresar su contraseña.');
        }

        // || Todo bien, todo correcto y yo que me alegro.

        $carritos = carrito::where('session_id', '=', Session::getId())->get();
        if(Auth::attempt($credenciales)){
            $user = User::where('email', $credenciales['email'])->first();
            $carritosUser = carrito::where('user_id', $user->id)->get();
            if($user->activated == 1){
                // || Sincro de carrito
                request()->session()->regenerate();

                if(count($carritosUser) == 0) {
                    foreach($carritos as $c) {
                        $c->session_id = Session::getId();
                        $c->user_id = Auth::user()->id;
                        $c->save();
                    }
                }

                foreach($carritosUser as $c) {
                    foreach($carritos as $cc) {
                        if($cc->book_isbn == $c->book_isbn){
                            $c->cantidad += $cc->cantidad;
                            $cc->delete();
                        }
                    }
                    $c->session_id = Session::getId();
                    $c->user_id = Auth::user()->id;
                    $c->save();
                }


                //

                if($request->checkout){
                    return redirect('/es/checkout');
                }
                else {
                    return redirect('/');
                }

            }
            else {
                return redirect('/es/iniciar-sesion')->with('message', 'Usuario no activado.');
            }
        }

        // || Todo mal. A ver si nos anotamos las contraseñas en algún papelito y empezamos a ahorrarnos eso de programar el 'reestablecer contraseña'.
        return redirect('/es/iniciar-sesion')->with('message', 'Email o Contraseña incorrectos.');
    }

    function logout(Request $request){
        Auth::logout();
        request()->session()->regenerate();
        return redirect('/');
    }

    function verifyManual(Request $request) {
        $credenciales = $request->only('email', 'password');

        // || Email vacio.
        if($credenciales['email'] == ""){
            return redirect($request->redirect)->with('message', 'Debe ingresar su email.');
        }

        // || Password vacio.
        else if($credenciales['password'] == "") {
            return redirect($request->redirect)->with('message', 'Debe ingresar su contraseña.');
        }

        // || Todo bien, todo correcto y yo que me alegro.
        if(Auth::attempt($credenciales)){
            $user = User::where('email', $credenciales['email'])->first();
            if($user->activated == 1){
                request()->session()->regenerate();
                //
                return redirect($request->redirect)->with('message', 'Sesion iniciada');

            }
            else {
                return redirect($request->redirect)->with('message', 'Usuario no activado.');
            }
        }

        // || Todo mal. A ver si nos anotamos las contraseñas en algún papelito y empezamos a ahorrarnos eso de programar el 'reestablecer contraseña'.

        return redirect($request->redirect)->with('message', 'Email o Contraseña incorrectos.');
    }

}

