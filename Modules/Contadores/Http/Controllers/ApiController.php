<?php

namespace TypiCMS\Modules\Contadores\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Contadores\Models\Contadore;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Contadore::class)
            ->selectFields($request->input('fields.contadores'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Contadore $contadore, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($contadore->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $contadore->setTranslation($key, $lang, $value);
                }
            } else {
                $contadore->{$key} = $content;
            }
        }

        $contadore->save();
    }

    public function destroy(Contadore $contadore)
    {
        $contadore->delete();
    }
}
