<?php

namespace TypiCMS\Modules\Libros\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Libros\Models\Libro;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Libro::class)
            ->selectFields($request->input('fields.libros'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Libro $libro, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($libro->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $libro->setTranslation($key, $lang, $value);
                }
            } else {
                $libro->{$key} = $content;
            }
        }

        $libro->save();
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
    }
}
