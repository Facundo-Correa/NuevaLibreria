<?php

namespace TypiCMS\Modules\Mercadolibrepreguntas\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Mercadolibrepreguntas\Models\Mercadolibrepregunta;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Mercadolibrepregunta::published()->order()->with('image')->get();

        return view('mercadolibrepreguntas::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Mercadolibrepregunta::published()->whereSlugIs($slug)->firstOrFail();

        return view('mercadolibrepreguntas::public.show')
            ->with(compact('model'));
    }
}
