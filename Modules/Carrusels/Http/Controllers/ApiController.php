<?php

namespace TypiCMS\Modules\Carrusels\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Carrusels\Models\Carrusel;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Carrusel::class)
            ->selectFields($request->input('fields.carrusels'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Carrusel $carrusel, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($carrusel->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $carrusel->setTranslation($key, $lang, $value);
                }
            } else {
                $carrusel->{$key} = $content;
            }
        }

        $carrusel->save();
    }

    public function destroy(Carrusel $carrusel)
    {
        $carrusel->delete();
    }
}
