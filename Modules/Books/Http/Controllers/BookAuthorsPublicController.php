<?php

namespace TypiCMS\Modules\Bookauthors\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Bookauthors\Models\Bookauthor;

class BookAuthorsPublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Bookauthor::published()->order()->with('image')->get();

        return view('bookauthors::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Bookauthor::published()->whereSlugIs($slug)->firstOrFail();

        return view('bookauthors::public.show')
            ->with(compact('model'));
    }
}
