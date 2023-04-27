<?php

namespace TypiCMS\Modules\Books\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Filters\FilterOrBooks;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Promocions\Models\Promocion;

// || Desde acá se controlan los filtros del buscador.

class BooksApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Book::class)
            ->selectFields($request->input('fields.books'))
            ->allowedSorts(['title'])
            ->allowedIncludes(['descriptions', 'tags'])
            ->allowedFilters([
                AllowedFilter::custom('title,isbn,publisher', new FilterOrBooks()),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    // || Esta funcion es para obtener libros por lote mediante sus ISBN
    public function getISBNS(Request $req) {
        $isbns = $req->isbns;
        $books = [];

        if(gettype($isbns) == 'array'){
            foreach($isbns as $i){
                $book = Books::where('isbn', $i)->orWhere('isbn1', $i)->first();
                if($book == null) {
                    break;
                }

                array_push($books, $book);
                $index = 0;
                /*foreach (Promocion::orderBy('id', 'asc')->get() as $promo) {
                    $imp = explode(',', $promo->books_isbns);
                    if(in_array($book->isbn, $imp)){
                        $indice = array_search($book->isbn, $imp);

                        //$price = explode(',', $promo->books_prices)[$indice] - ((explode(',', $promo->books_prices)[$indice] * explode(',', $promo->books_desc)[$indice]) / 100);
                        //dd($indice, $promo->books_prices, explode(',', $promo->books_prices)[$indice]);
                        //$book->price = $price;


                        break;
                    }
                    $index++;
                }*/
            }
        }
        else {
            $isbns = explode('"', $isbns);

            foreach($isbns as $i){
                if($i != ',' && $i != '[' && $i != ']'){
                    $book = Books::where('isbn', $i)->orWhere('isbn1', $i)->first();
                    if($book == null) {

                        break;
                    }

                    array_push($books, $book);
                    //var_dump("LIBRO: " . $book . " ISBN OTORGADO: " . $i . " \n");
                }
            }
        }

        //dd($books);
        return response()->json([
            'data' => $books
        ]);


    }

    // || Esta funcion redirigira a la vista de libros con el libro correspondiente
    public function redirectToBook($isbn){
        if($model = Book::where('isbn', $isbn)->get()->first()){
             return view('core::public.master', compact('model'));
        }
    }

    protected function updatePartial(Book $book, Request $request)
    {
        // foreach ($request->only('status') as $key => $content) {
        //     if ($book->isTranslatableAttribute($key)) {
        //         foreach ($content as $lang => $value) {
        //             $book->setTranslation($key, $lang, $value);
        //         }
        //     } else {
        //         $book->{$key} = $content;
        //     }
        // }

        $book->save();
    }

    public function destroy(Book $book)
    {
        $book->delete();
    }
}
