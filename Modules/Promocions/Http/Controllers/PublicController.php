<?php

namespace TypiCMS\Modules\Promocions\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Promocions\Models\Promocion;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Promocion::published()->order()->with('image')->get();

        return view('promocions::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Promocion::published()->whereSlugIs($slug)->firstOrFail();

        return view('promocions::public.show')
            ->with(compact('model'));
    }
}
