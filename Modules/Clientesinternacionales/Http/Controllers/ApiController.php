<?php

namespace TypiCMS\Modules\Clientesinternacionales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Clientesinternacionales\Models\Clientesinternacionale;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Clientesinternacionale::class)
            ->selectFields($request->input('fields.clientesinternacionales'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Clientesinternacionale $clientesinternacionale, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($clientesinternacionale->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $clientesinternacionale->setTranslation($key, $lang, $value);
                }
            } else {
                $clientesinternacionale->{$key} = $content;
            }
        }

        $clientesinternacionale->save();
    }

    public function destroy(Clientesinternacionale $clientesinternacionale)
    {
        $clientesinternacionale->delete();
    }
}
