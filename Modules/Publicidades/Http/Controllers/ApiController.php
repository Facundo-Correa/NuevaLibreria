<?php

namespace TypiCMS\Modules\Publicidades\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Publicidades\Models\Publicidade;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Publicidade::class)
            ->selectFields($request->input('fields.publicidades'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Publicidade $publicidade, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($publicidade->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $publicidade->setTranslation($key, $lang, $value);
                }
            } else {
                $publicidade->{$key} = $content;
            }
        }

        $publicidade->save();
    }

    public function destroy(Publicidade $publicidade)
    {
        $publicidade->delete();
    }
}
