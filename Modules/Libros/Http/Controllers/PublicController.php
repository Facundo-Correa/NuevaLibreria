<?php

namespace TypiCMS\Modules\Libros\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Libros\Models\Libro;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Libro::published()->order()->with('image')->get();

        return view('libros::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Libro::published()->whereSlugIs($slug)->firstOrFail();

        return view('libros::public.show')
            ->with(compact('model'));
    }
}
