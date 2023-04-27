<?php

namespace TypiCMS\Modules\Menuses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Menuses\Models\Menus;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Menus::class)
            ->selectFields($request->input('fields.menuses'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Menus $menus, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($menus->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $menus->setTranslation($key, $lang, $value);
                }
            } else {
                $menus->{$key} = $content;
            }
        }

        $menus->save();
    }

    public function destroy(Menus $menus)
    {
        $menus->delete();
    }
}
