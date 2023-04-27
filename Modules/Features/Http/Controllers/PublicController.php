<?php

namespace TypiCMS\Modules\Features\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Features\Models\Feature;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Feature::published()->order()->with('image')->get();

        return view('features::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Feature::published()->whereSlugIs($slug)->firstOrFail();

        return view('features::public.show')
            ->with(compact('model'));
    }
}
