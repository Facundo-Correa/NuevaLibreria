<?php

namespace TypiCMS\Modules\Inicios\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Inicios\Models\Inicio;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Inicio::published()->order()->with('image')->get();

        return view('inicios::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Inicio::published()->whereSlugIs($slug)->firstOrFail();

        return view('inicios::public.show')
            ->with(compact('model'));
    }
}
