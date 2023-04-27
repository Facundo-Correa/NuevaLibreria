<?php

namespace TypiCMS\Modules\Booklists\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Booklists\Models\Booklist;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Booklist::published()->order()->with('image')->get();

        return view('booklists::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Booklist::published()->whereSlugIs($slug)->firstOrFail();

        return view('booklists::public.show')
            ->with(compact('model'));
    }
}
