<?php

namespace TypiCMS\Modules\Promocions\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Promocions\Exports\Export;
use TypiCMS\Modules\Promocions\Facades\Promocions;
use TypiCMS\Modules\Promocions\Http\Requests\FormRequest;
use TypiCMS\Modules\Promocions\Models\Promocion;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('promocions::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' promocions.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Promocion();

        return view('promocions::admin.create')
            ->with(compact('model'));
    }

    public function edit(promocion $promocion): View
    {
        return view('promocions::admin.edit')
            ->with(['model' => $promocion]);
    }

    public function store(FormRequest $request): RedirectResponse
    {

        //dd($request);
        $promocion = Promocion::create($request->validated());
        $name = explode(' ', $request->title['es']);
        $end = '';
        foreach($name as $n){
            $end.= $n;
        }
        $promocion->name = $end;
        $promocion->save();
        return $this->redirect($request, $promocion);
    }

    public function update(promocion $promocion, FormRequest $request): RedirectResponse
    {

        $promocion->update($request->validated());

        $name = explode(' ', $request->title['es']);
        $end = '';
        foreach($name as $n){
            $end.= $n;
        }
        $promocion->name = $end;

        $promocion->books_isbns = $request->books_isbns;
        $promocion->save();

        return $this->redirect($request, $promocion);
    }

    public function guardar_libros(Request $req){

        $promo = Promocions::where('id', $req->id)->first();

        $promo->books_isbns = '';
        $promo->books_prices = '';
        $promo->books_desc = '';

        $precios = $req->precios;
        $preciosFinal = '';
        $index = 0;
        /*foreach(explode(',', $precios) as $precio) {
            if($precio == 0) {
                if($p = Books::where('isbn', explode(',', $req->isbns)[$index])
                    ->orWhere('isbn1', explode(',', $req->isbns[$index]))->first()) {
                    $preciosFinal.=$p->price . ',';
                }

                else {
                    break;
                }
            }
            else {
                $preciosFinal.=$precio . ',';
            }

            $index++;
        }

        // || Chequeo de existencia
        /*$final_isbn = '';
        foreach(explode(',', $req->isbns) as $isbn) {
            if($book = Book::where('isbn', $isbn)->orWhere('isbn1', $isbn)->first()) {
                $final_isbn .= $isbn . ',';
            }
        }*/
        /////////////////////////////
        $fIsbns = '';
        $fDescuentos = '';
        $isbns = $req->isbns;
        $prices = explode(',', $precios);
        $discounts = explode(',', $req->descuentos);
        $book_num = 0;

        foreach(explode(',', $isbns) as $isbn) {
            if($book = Book::where('isbn', $isbn)->orWhere('isbn1', $isbn)->first()) {
                $fIsbns .= $book->isbn . ',';

                if(isset($prices[$book_num])) {
                    if($prices[$book_num]  == 0) {
                        $preciosFinal .= $book->price . ',';
                    }
                    else
                        $preciosFinal.=$prices[$book_num];
                }

                if(isset($discounts[$book_num])){
                    $fDescuentos .= $discounts[$book_num];
                }
            }

            $book_num++;
        }

        $promo->books_isbns = $fIsbns;
        $promo->books_prices = $preciosFinal;
        $promo->books_desc = $req->descuentos;
        $promo->save();
    }

    public function getCreatedHCPromo (Request $req) {
        $promo_code = $req->promo_code;

        if ($promos = Promocion::where('especial', 1)->get()) {
            foreach ($promos as $promo) {
                switch ($promo_code) {
                    case 1:
                        if(json_decode($promo->title)->es == 'Mas vendido') {
                            return $promo;
                        }
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                }
            }
        }
        else {
            // retornar "No se creo la promocion"
        }


    }
}
