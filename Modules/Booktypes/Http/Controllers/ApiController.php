<?php

namespace TypiCMS\Modules\Booktypes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Booktypes\Models\Booktype;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Booktype::class)
            ->selectFields($request->input('fields.booktypes'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Booktype $booktype, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($booktype->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $booktype->setTranslation($key, $lang, $value);
                }
            } else {
                $booktype->{$key} = $content;
            }
        }

        $booktype->save();
    }

    public function destroy(Booktype $booktype)
    {
        $booktype->delete();
    }
}
