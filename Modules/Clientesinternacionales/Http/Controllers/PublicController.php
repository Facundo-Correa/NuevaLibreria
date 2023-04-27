<?php

namespace TypiCMS\Modules\Clientesinternacionales\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Clientesinternacionales\Models\Clientesinternacionale;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Clientesinternacionale::published()->order()->with('image')->get();

        return view('clientesinternacionales::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Clientesinternacionale::published()->whereSlugIs($slug)->firstOrFail();

        return view('clientesinternacionales::public.show')
            ->with(compact('model'));
    }
}
