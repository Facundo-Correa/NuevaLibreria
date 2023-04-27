<?php

namespace TypiCMS\Modules\Mercadolibrepedidos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Mercadolibrepedidos\Models\Mercadolibrepedido;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Mercadolibrepedido::class)
            ->selectFields($request->input('fields.mercadolibrepedidos'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Mercadolibrepedido $mercadolibrepedido, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($mercadolibrepedido->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $mercadolibrepedido->setTranslation($key, $lang, $value);
                }
            } else {
                $mercadolibrepedido->{$key} = $content;
            }
        }

        $mercadolibrepedido->save();
    }

    public function destroy(Mercadolibrepedido $mercadolibrepedido)
    {
        $mercadolibrepedido->delete();
    }
}
