<?php

namespace TypiCMS\Modules\Mercadolibrepedidos\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Mercadolibrepedidos\Models\Mercadolibrepedido;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Mercadolibrepedido::published()->order()->with('image')->get();

        return view('mercadolibrepedidos::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Mercadolibrepedido::published()->whereSlugIs($slug)->firstOrFail();

        return view('mercadolibrepedidos::public.show')
            ->with(compact('model'));
    }
}
