<?php

namespace TypiCMS\Modules\Buscars\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Buscars\Exports\Export;
use TypiCMS\Modules\Buscars\Http\Requests\FormRequest;
use TypiCMS\Modules\Buscars\Models\Buscar;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('buscars::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' buscars.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Buscar();

        return view('buscars::admin.create')
            ->with(compact('model'));
    }

    public function edit(buscar $buscar): View
    {
        return view('buscars::admin.edit')
            ->with(['model' => $buscar]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $buscar = Buscar::create($request->validated());

        return $this->redirect($request, $buscar);
    }

    public function update(buscar $buscar, FormRequest $request): RedirectResponse
    {
        $buscar->update($request->validated());

        return $this->redirect($request, $buscar);
    }
}
