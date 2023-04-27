<?php

namespace TypiCMS\Modules\Configuraciones\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Configuraciones\Models\Configuracione;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Configuracione::published()->order()->with('image')->get();

        return view('configuraciones::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Configuracione::published()->whereSlugIs($slug)->firstOrFail();

        return view('configuraciones::public.show')
            ->with(compact('model'));
    }
}
