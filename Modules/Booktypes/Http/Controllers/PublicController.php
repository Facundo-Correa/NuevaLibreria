<?php

namespace TypiCMS\Modules\Booktypes\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Booktypes\Models\Booktype;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Booktype::published()->order()->with('image')->get();

        return view('booktypes::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Booktype::published()->whereSlugIs($slug)->firstOrFail();

        return view('booktypes::public.show')
            ->with(compact('model'));
    }
}
