<?php

namespace TypiCMS\Modules\Features\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Features\Models\Feature;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Feature::class)
            ->selectFields($request->input('fields.features'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Feature $feature, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($feature->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $feature->setTranslation($key, $lang, $value);
                }
            } else {
                $feature->{$key} = $content;
            }
        }

        $feature->save();
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
    }
}
