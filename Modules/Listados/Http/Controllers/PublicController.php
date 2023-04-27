<?php

namespace TypiCMS\Modules\Listados\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Listados\Models\Listado;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Listado::published()->order()->with('image')->get();

        return view('listados::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Listado::published()->whereSlugIs($slug)->firstOrFail();

        return view('listados::public.show')
            ->with(compact('model'));
    }
}
