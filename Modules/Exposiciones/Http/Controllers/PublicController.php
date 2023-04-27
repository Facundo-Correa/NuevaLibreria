<?php

namespace TypiCMS\Modules\Exposiciones\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Exposiciones\Models\Exposicione;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Exposicione::published()->order()->with('image')->get();

        return view('exposiciones::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Exposicione::published()->whereSlugIs($slug)->firstOrFail();

        return view('exposiciones::public.show')
            ->with(compact('model'));
    }
}
