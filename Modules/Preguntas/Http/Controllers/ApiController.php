<?php

namespace TypiCMS\Modules\Preguntas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Preguntas\Models\Pregunta;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Pregunta::class)
            ->selectFields($request->input('fields.preguntas'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Pregunta $pregunta, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($pregunta->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $pregunta->setTranslation($key, $lang, $value);
                }
            } else {
                $pregunta->{$key} = $content;
            }
        }

        $pregunta->save();
    }

    public function destroy(Pregunta $pregunta)
    {
        $pregunta->delete();
    }
}
