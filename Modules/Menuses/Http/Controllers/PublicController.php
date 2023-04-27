<?php

namespace TypiCMS\Modules\Menuses\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Menuses\Models\Menus;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Menus::published()->order()->with('image')->get();

        return view('menuses::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Menus::published()->whereSlugIs($slug)->firstOrFail();

        return view('menuses::public.show')
            ->with(compact('model'));
    }
}
