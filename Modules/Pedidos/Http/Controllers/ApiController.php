<?php

namespace TypiCMS\Modules\Pedidos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Pedidos\Models\Pedido;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Pedido::class)
            ->selectFields($request->input('fields.pedidos'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Pedido $pedido, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($pedido->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $pedido->setTranslation($key, $lang, $value);
                }
            } else {
                $pedido->{$key} = $content;
            }
        }

        $pedido->save();
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
    }
}
