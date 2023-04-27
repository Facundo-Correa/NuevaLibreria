<?php

namespace TypiCMS\Modules\Configuraciones\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Configuraciones\Models\Configuracione;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Configuracione::class)
            ->selectFields($request->input('fields.configuraciones'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Configuracione $configuracione, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($configuracione->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $configuracione->setTranslation($key, $lang, $value);
                }
            } else {
                $configuracione->{$key} = $content;
            }
        }

        $configuracione->save();
    }

    public function destroy(Configuracione $configuracione)
    {
        $configuracione->delete();
    }
}
