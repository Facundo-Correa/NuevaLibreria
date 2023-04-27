<?php

namespace TypiCMS\Modules\Exposiciones\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Exposiciones\Exports\Export;
use TypiCMS\Modules\Exposiciones\Http\Requests\FormRequest;
use TypiCMS\Modules\Exposiciones\Models\Exposicione;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('exposiciones::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' exposiciones.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Exposicione();

        return view('exposiciones::admin.create')
            ->with(compact('model'));
    }

    public function edit(exposicione $exposicione): View
    {
        return view('exposiciones::admin.edit')
            ->with(['model' => $exposicione]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $exposicione = Exposicione::create($request->validated());

        return $this->redirect($request, $exposicione);
    }

    public function update(exposicione $exposicione, FormRequest $request): RedirectResponse
    {
        $exposicione->update($request->validated());

        return $this->redirect($request, $exposicione);
    }
}
