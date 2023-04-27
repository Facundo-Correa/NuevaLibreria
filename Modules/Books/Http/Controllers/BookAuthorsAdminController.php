<?php

namespace TypiCMS\Modules\Bookauthors\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Bookauthors\Exports\Export;
use TypiCMS\Modules\Bookauthors\Http\Requests\FormRequest;
use TypiCMS\Modules\Bookauthors\Models\Bookauthor;

class BookAuthorsAdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('bookauthors::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' bookauthors.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Bookauthor();

        return view('bookauthors::admin.create')
            ->with(compact('model'));
    }

    public function edit(bookauthor $bookauthor): View
    {
        return view('bookauthors::admin.edit')
            ->with(['model' => $bookauthor]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $bookauthor = Bookauthor::create($request->validated());

        return $this->redirect($request, $bookauthor);
    }

    public function update(bookauthor $bookauthor, FormRequest $request): RedirectResponse
    {
        $bookauthor->update($request->validated());

        return $this->redirect($request, $bookauthor);
    }
}
