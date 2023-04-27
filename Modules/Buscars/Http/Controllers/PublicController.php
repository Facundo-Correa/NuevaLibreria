<?php

namespace TypiCMS\Modules\Buscars\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Buscars\Models\Buscar;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Buscar::published()->order()->with('image')->get();

        return view('buscars::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Buscar::published()->whereSlugIs($slug)->firstOrFail();

        return view('buscars::public.show')
            ->with(compact('model'));
    }
}
