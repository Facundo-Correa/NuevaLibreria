<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Categorias\Facades\Categorias;

class BookController extends Controller
{
    //
    public function paginate($page = 1){
        $categoria = null; 
        $nuestraEditorial = 'no';
        return view('pages::public.tienda', compact('categoria', 'page', 'nuestraEditorial'));
    }
    
    public function paginateWithCategory($categoria, $page = 0){
        //return redirect('/es/tienda/')->with('page', $page)->with('categoria', $categoria);  
        //return view('pages::public.tienda')->with('page', $page)->with('categoria', $categoria);
        
        $nuestraEditorial = 'no';
        return view('pages::public.tienda', compact('categoria', 'page', 'nuestraEditorial'));
    }

    public function getBook($isbn){
        $libro = Books::where('isbn', $isbn)->first();
        return view('pages::public.detalle-libro', ['lib' => $libro]);
    }

    
    public function search($busqueda = ''){
        return redirect('/es/tienda/')->with('busqueda', $busqueda);
    }
    
    public function getOurEditorial($page){
        $nuestraEditorial = 'yes';
        $categoria = null;
        return view('pages::public.tienda', compact('nuestraEditorial', 'page', 'categoria'));
    }

    public function getOurEditorialWithCategory($category, $page) {
        $nuestraEditorial = 'yes';
        $categoria = $category;
        return view('pages::public.tienda', compact('categoria', 'page', 'nuestraEditorial'));
    }

}
