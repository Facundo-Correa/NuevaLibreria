<?php

namespace TypiCMS\Modules\Publicidades\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Publicidades\Models\Publicidade;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Publicidade::published()->order()->with('image')->get();

        return view('publicidades::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Publicidade::published()->whereSlugIs($slug)->firstOrFail();

        return view('publicidades::public.show')
            ->with(compact('model'));
    }
}
