<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TypiCMS\Modules\News\Models\News;

class BlogController extends Controller
{
    public function get() {
        $pagina = request()['pagina'];
        return view('pages::public.blog', compact('pagina'));

    }

    public function show($id)
    {
        $post = News::where('id', $id)->first();
        return view('pages::public.detalle-blog', compact('post'));
    }

    public function find()
    {
        $pagina = request('pagina');
        $busqueda = request('busqueda');
        $resultados = json_decode(DB::table('news')->whereFullText('title', strtolower($busqueda))->get());
        return view('pages::public.blog', compact('resultados', 'pagina'));

    }

    public function categoria(Request $req)
    {
        $categoria = $req->categoria;
        $resultados = json_decode(DB::table('news')->whereFullText('categoria', strtolower($categoria))->get());
        return view('pages::public.blog', compact('resultados'));
    }
}
