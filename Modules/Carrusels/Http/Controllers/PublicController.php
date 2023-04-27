<?php

namespace TypiCMS\Modules\Carrusels\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Carrusels\Models\Carrusel;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Carrusel::published()->order()->with('image')->get();

        return view('carrusels::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Carrusel::published()->whereSlugIs($slug)->firstOrFail();

        return view('carrusels::public.show')
            ->with(compact('model'));
    }
}
