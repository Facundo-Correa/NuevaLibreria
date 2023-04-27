<?php

namespace TypiCMS\Modules\Promocions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Promocions\Facades\Promocions;
use TypiCMS\Modules\Promocions\Models\Promocion;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Promocion::class)
            ->selectFields($request->input('fields.promocions'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Promocion $promocion, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($promocion->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $promocion->setTranslation($key, $lang, $value);
                }
            } else {
                $promocion->{$key} = $content;
            }
        }

        $promocion->save();
    }

    public function destroy(Promocion $promocion)
    {
        $promocion->delete();
    }

    function checkPromocion(Request $req){
        $isbn = $req->isbn;

        if(gettype($req->isbn) == 'string'){
            $isbn = array($req->isbn);
        }


        $check = [];
        $promo = Promocions::all();

        foreach($promo as $p){
            $isbns = explode(',', $p->books_isbns);

            $check = $this->checkIfInArray($isbns, $isbn[0]);
            if($check[0]){
                $promo = $p;
                break;
            }
        }        

        if($check[0]){
            // || retorno del precio en promocion
            $precio = explode(',', $p->books_prices)[$check[1]];
            $descuento = explode(',', $p->books_desc)[$check[1]];

            $precio = (int)($precio);
            $descuento = (int)($descuento);

            $dineroDescuento = ($descuento*$precio) / 100;

            return $precio - $dineroDescuento;
        } else {
            return 'null';
        }
    }

    private function checkIfInArray($arr, $val){
        $index = 0;
        foreach($arr as $a){
            if(strcmp($a, $val) === 0){
                return array(true, $index);
            }

            $index++;
        }
        return array(false, 0);
    }

    public function updateImported (Request $req) {
        $promoCode = $req->promo_code;
        $name = 'MasVendidos';
        $title = 'Mas vendidos';
        $location = 'sincro_nl/';
        switch ($promoCode) {
            case 1:
                $title = 'Mas Vendidos';
                $name = 'MasVendidos';
                $location.='masvendidos.txt';
                break;
            case 2:
                $title = 'Novedades';
                $name = 'Novedades';
                $location.='novedades.txt';
                break;
            case 3:
                $title = 'Recomendados';
                $name = 'Recomendados';
                $location.='recomendados.txt';
                break;
        }
        $books = '';
        $document = fopen($location, 'r');
        while($line = fgets($document)){
            $information = explode('"', $line);
            if(isset($information[1])){
                if(Books::where('isbn', $information[1])->first()) {
                    $books .= $information[1] . ',';
                }
            }
        }
        if($model = Promocion::where('id', $promoCode)->first()) {
            // || Update model
            $titleArr = array(
                "es" => $title,
                "en" => $title
            );
            $model->id = $promoCode;
            $model->title = $titleArr;
            $model->slug = 'importada' . $title;
            $model->title = $titleArr;
            $model->name = $name;
            $model->books_isbns = $books;
            $model->books_prices = '';
            $model->books_desc = '';
            $statusArr = array (
                'es' => "1",
                "en" => "0"
            );
            $model->status=$statusArr;
            $model->posicion = 0;
            $model->seccion = 0;
            $model->save();
        }
        else {
            // || Create model
            $model = new Promocion();
            $model->id = $promoCode;
            $titleArr = array(
                "es" => $title,
                "en" => $title
            );
            $model->title = $titleArr;
            $model->name = $name;
            $model->slug = 'importada' . $title;
            $model->books_isbns = $books;
            $model->books_prices = '';
            $model->books_desc = '';
            $statusArr = array (
                'es' => "1",
                "en" => "0"
            );
            $model->status=$statusArr;
            $model->posicion = 0;
            $model->seccion = 0;
            $model->save();
        }

        return response()->json([
            'data' => 'Promoción actualizada'
        ]);
    }
}
