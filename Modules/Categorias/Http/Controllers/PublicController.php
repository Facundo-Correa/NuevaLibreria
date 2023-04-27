<?php

namespace TypiCMS\Modules\Categorias\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Categorias\Models\Categoria;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Categoria::published()->order()->with('image')->get();

        return view('categorias::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Categoria::published()->whereSlugIs($slug)->firstOrFail();

        return view('categorias::public.show')
            ->with(compact('model'));
    }
}
