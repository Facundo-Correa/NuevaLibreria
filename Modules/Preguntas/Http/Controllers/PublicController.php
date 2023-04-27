<?php

namespace TypiCMS\Modules\Preguntas\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Preguntas\Models\Pregunta;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Pregunta::published()->order()->with('image')->get();

        return view('preguntas::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Pregunta::published()->whereSlugIs($slug)->firstOrFail();

        return view('preguntas::public.show')
            ->with(compact('model'));
    }
}
