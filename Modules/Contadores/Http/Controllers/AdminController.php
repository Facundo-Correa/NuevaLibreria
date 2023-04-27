<?php

namespace TypiCMS\Modules\Contadores\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Contadores\Exports\Export;
use TypiCMS\Modules\Contadores\Http\Requests\FormRequest;
use TypiCMS\Modules\Contadores\Models\Contadore;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('contadores::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' contadores.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Contadore();

        return view('contadores::admin.create')
            ->with(compact('model'));
    }

    public function edit(contadore $contadore): View
    {
        return view('contadores::admin.edit')
            ->with(['model' => $contadore]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $contadore = Contadore::create($request->validated());

        return $this->redirect($request, $contadore);
    }

    public function update(contadore $contadore, FormRequest $request): RedirectResponse
    {
        $contadore->update($request->validated());

        return $this->redirect($request, $contadore);
    }
}
