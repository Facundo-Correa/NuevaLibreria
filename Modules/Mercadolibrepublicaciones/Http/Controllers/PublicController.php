<?php

namespace TypiCMS\Modules\Mercadolibrepublicaciones\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Mercadolibrepublicaciones\Models\Mercadolibrepublicacione;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Mercadolibrepublicacione::published()->order()->with('image')->get();

        return view('mercadolibrepublicaciones::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Mercadolibrepublicacione::published()->whereSlugIs($slug)->firstOrFail();

        return view('mercadolibrepublicaciones::public.show')
            ->with(compact('model'));
    }
}
