<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TypiCMS\Modules\Preguntas\Facades\Preguntas;
use TypiCMS\Modules\Preguntas\Models\Pregunta;

class PreguntasController extends Controller
{   
    public function get(Request $request) {
        $pagina = $request->pag ?? 1;
        $preguntasPerPag = 10;
        $totalPreguntas = 0;
        $totalPaginas = 0;
        //->paginate($posts_per_page, ['*'], 'page', $actual_page);
        
        $preguntasContestadas = [];
        $preguntasSinResponder = [];

        $preguntasSinResponder = Preguntas::where([
            ['respuestas', null],

        ])->orderBy('id', 'DESC')
        ->paginate($preguntasPerPag, ['*'], 'page', $pagina);
        
        
        $preguntasContestadas = Preguntas::where([
            ['respuestas', '!=', null],
        ])->orderBy('id', 'DESC')
        ->paginate($preguntasPerPag, ['*'], 'page', $pagina);
        
        return response()->json([
            'sinResponder' => $preguntasSinResponder,
            'contestadas' => $preguntasContestadas,
        ]);
    }

    public function getByPub(Request $request) {
        $pagina = $request->pagina;
        $preguntasPerPag = 3;
        $totalPreguntas = 0;
        $totalPaginas = 0;
        $publicacion = $request->publicacion;
        //->paginate($posts_per_page, ['*'], 'page', $actual_page);
        
        $preguntasContestadas = [];
        $preguntasSinResponder = [];

        $preguntasSinResponder = Preguntas::where([
            ['respuestas', null],
            ['publicacion', $publicacion]

        ])->orderBy('id', 'DESC')
        ->paginate($preguntasPerPag, ['*'], 'page', $pagina);
        
        
        $preguntasContestadas = Preguntas::where([
            ['respuestas', '!=', null],
            ['publicacion', $publicacion]
        ])->orderBy('id', 'DESC')
        ->paginate($preguntasPerPag, ['*'], 'page', $pagina);
        
        

        return response()->json([
            'sinResponder' => $preguntasSinResponder,
            'contestadas' => $preguntasContestadas,
            'totalPaginas' => $preguntasContestadas->lastPage() + $preguntasSinResponder->lastPage()
        ]);
    }

    public function guardar(Request $request) {
        $pregunta = new Pregunta();

        if(Auth::user() == null) {
            return response()->json([
                'message' => 'Es necesario que inicie sesion para preguntar'
            ]);
        } 
        
        $pregunta->Nombre_y_apellido = Auth::user()->email;
        $pregunta->body = $request->body;
        
        if($pregunta->body == null) {
            return response()->json([
                'message' => 'Es necesario que escriba una pregunta'
            ]);
        }

        $pregunta->publicacion = $request->publicacion;
        $pregunta->libro = $request->libro;

        

        $pregunta->save();
    }

    public function answer(Request $request) {
        $id = $request->id;
        $respuesta = $request->respuesta;

        $pregunta = Pregunta::where('id', $id)->first();
        $pregunta->respuestas = [
            'es' => $respuesta
        ];

        $pregunta->respuestas = json_encode($pregunta->respuestas);
        
        $pregunta->save();
    }

    public function getByID(Request $req) {
        $id = $req->id;
        return Pregunta::where('id', $id)->first();
    }
}
