<?php

namespace TypiCMS\Modules\Categorias\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Categorias\Models\Categoria;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Categoria::class)
            ->selectFields($request->input('fields.categorias'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Categoria $categoria, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($categoria->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $categoria->setTranslation($key, $lang, $value);
                }
            } else {
                $categoria->{$key} = $content;
            }
        }

        $categoria->save();
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
    }
}
