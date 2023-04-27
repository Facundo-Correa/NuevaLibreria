<?php

namespace TypiCMS\Modules\Books\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Books\Models\Book;

class BooksPublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Book::published()->order()->with('image')->get();

        return view('books::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Book::published()->whereSlugIs($slug)->firstOrFail();

        return view('books::public.show')
            ->with(compact('model'));
    }
}
