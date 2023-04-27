<?php

namespace TypiCMS\Modules\Listados\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Listados\Models\Listado;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Listado::class)
            ->selectFields($request->input('fields.listados'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Listado $listado, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($listado->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $listado->setTranslation($key, $lang, $value);
                }
            } else {
                $listado->{$key} = $content;
            }
        }

        $listado->save();
    }

    public function destroy(Listado $listado)
    {
        $listado->delete();
    }
}
