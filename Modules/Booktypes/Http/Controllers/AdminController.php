<?php

namespace TypiCMS\Modules\Booktypes\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Booktypes\Exports\Export;
use TypiCMS\Modules\Booktypes\Http\Requests\FormRequest;
use TypiCMS\Modules\Booktypes\Models\Booktype;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('booktypes::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' booktypes.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Booktype();

        return view('booktypes::admin.create')
            ->with(compact('model'));
    }

    public function edit(booktype $booktype): View
    {
        return view('booktypes::admin.edit')
            ->with(['model' => $booktype]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $booktype = Booktype::create($request->validated());

        return $this->redirect($request, $booktype);
    }

    public function update(booktype $booktype, FormRequest $request): RedirectResponse
    {
        $booktype->update($request->validated());

        return $this->redirect($request, $booktype);
    }
}
