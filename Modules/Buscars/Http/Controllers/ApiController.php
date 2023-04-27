<?php

namespace TypiCMS\Modules\Buscars\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Buscars\Models\Buscar;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Buscar::class)
            ->selectFields($request->input('fields.buscars'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Buscar $buscar, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($buscar->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $buscar->setTranslation($key, $lang, $value);
                }
            } else {
                $buscar->{$key} = $content;
            }
        }

        $buscar->save();
    }

    public function destroy(Buscar $buscar)
    {
        $buscar->delete();
    }
}
