<?php

namespace TypiCMS\Modules\Mercadolibrepublicaciones\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Mercadolibrepublicaciones\Models\Mercadolibrepublicacione;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Mercadolibrepublicacione::class)
            ->selectFields($request->input('fields.mercadolibrepublicaciones'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Mercadolibrepublicacione $mercadolibrepublicacione, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($mercadolibrepublicacione->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $mercadolibrepublicacione->setTranslation($key, $lang, $value);
                }
            } else {
                $mercadolibrepublicacione->{$key} = $content;
            }
        }

        $mercadolibrepublicacione->save();
    }

    public function destroy(Mercadolibrepublicacione $mercadolibrepublicacione)
    {
        $mercadolibrepublicacione->delete();
    }
}
