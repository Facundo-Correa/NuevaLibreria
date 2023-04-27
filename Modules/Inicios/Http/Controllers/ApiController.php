<?php

namespace TypiCMS\Modules\Inicios\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Inicios\Models\Inicio;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Inicio::class)
            ->selectFields($request->input('fields.inicios'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Inicio $inicio, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($inicio->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $inicio->setTranslation($key, $lang, $value);
                }
            } else {
                $inicio->{$key} = $content;
            }
        }

        $inicio->save();
    }

    public function destroy(Inicio $inicio)
    {
        $inicio->delete();
    }
}
