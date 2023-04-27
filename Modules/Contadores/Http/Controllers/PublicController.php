<?php

namespace TypiCMS\Modules\Contadores\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Contadores\Models\Contadore;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Contadore::published()->order()->with('image')->get();

        return view('contadores::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Contadore::published()->whereSlugIs($slug)->firstOrFail();

        return view('contadores::public.show')
            ->with(compact('model'));
    }
}
