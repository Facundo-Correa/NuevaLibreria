<?php

namespace TypiCMS\Modules\Bookauthors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Bookauthors\Models\Bookauthor;

class BookAuthorsApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Bookauthor::class)
            ->selectFields($request->input('fields.bookauthors'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Bookauthor $bookauthor, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($bookauthor->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $bookauthor->setTranslation($key, $lang, $value);
                }
            } else {
                $bookauthor->{$key} = $content;
            }
        }

        $bookauthor->save();
    }

    public function destroy(Bookauthor $bookauthor)
    {
        $bookauthor->delete();
    }
}
