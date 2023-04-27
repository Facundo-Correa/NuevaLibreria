<?php

namespace TypiCMS\Modules\Booklists\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Booklists\Models\Booklist;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Booklist::class)
            ->selectFields($request->input('fields.booklists'))
            ->allowedSorts(['id', 'title', 'position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function indexPromos(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Booklist::class)
            ->selectFields($request->input('fields.booklists'))
            ->allowedSorts(['id', 'title', 'position'])
            ->allowedIncludes(['listsection'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->where('booklists_types_id', 1)
            ->paginate($request->input('per_page'));

        // $daton = Booklist::where('booklists_types_id', 1)->with('section')->get();

        // dd('daton', $data);

        return $data;
    }

    public function indexPublicidades(Request $request): LengthAwarePaginator
    {

        $data = QueryBuilder::for(Booklist::class)
            ->selectFields($request->input('fields.booklists'))
            ->allowedIncludes(['listsection'])
            ->allowedSorts(['id', 'title', 'position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->where('booklists_types_id', 2)
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function indexCarousels(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Booklist::class)
            ->selectFields($request->input('fields.booklists'))
            ->allowedIncludes(['listsection', 'image'])
            ->allowedSorts(['id', 'title', 'position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->where('booklists_types_id', 3)
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Booklist $booklist, Request $request)
    {
        $booklist->save();
    }

    public function destroy(Booklist $booklist)
    {
        $booklist->delete();
    }
}
