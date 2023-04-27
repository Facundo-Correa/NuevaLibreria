<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TypiCMS\Modules\Users\Models\User;

class RegisterController extends Controller
{
    function register(Request $request) {
        $r = $request;
     
        // ------------------------------------ //   
        // || Por ahora, solo email y password.
        // ------------------------------------ //
        
        $user = new User();
        $user->first_name = utf8_encode($r->first_name);
        $user->last_name = utf8_encode($r->last_name);
        $user->document = utf8_encode($r->document);
        $user->email = utf8_encode($r->email);
        $user->phone = utf8_encode($r->telefono);
        $user->country = utf8_encode($r->pais);
        $user->city = utf8_encode($r->ciudad);
        $user->locale = utf8_encode($r->localidad);
        $user->street = utf8_encode($r->calle);
        $user->number = utf8_encode($r->nCalle);
        $user->postal_code = utf8_encode($r->cPostal);

        $user->password = Hash::make($r->password);
        $user->save();
        

        // || Agregar auto logueo acá


        return redirect('/');
        // ------------------------------------ //
    }
}
