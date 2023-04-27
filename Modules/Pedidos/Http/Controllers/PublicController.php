<?php

namespace TypiCMS\Modules\Pedidos\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Pedidos\Models\Pedido;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Pedido::published()->order()->with('image')->get();

        return view('pedidos::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Pedido::published()->whereSlugIs($slug)->firstOrFail();

        return view('pedidos::public.show')
            ->with(compact('model'));
    }
}
