<?php

namespace TypiCMS\Modules\Exposiciones\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Exposiciones\Models\Exposicione;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Exposicione::class)
            ->selectFields($request->input('fields.exposiciones'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Exposicione $exposicione, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($exposicione->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $exposicione->setTranslation($key, $lang, $value);
                }
            } else {
                $exposicione->{$key} = $content;
            }
        }

        $exposicione->save();
    }

    public function destroy(Exposicione $exposicione)
    {
        $exposicione->delete();
    }
}
