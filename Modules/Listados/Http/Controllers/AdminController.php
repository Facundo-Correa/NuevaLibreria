<?php

namespace TypiCMS\Modules\Listados\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Listados\Exports\Export;
use TypiCMS\Modules\Listados\Http\Requests\FormRequest;
use TypiCMS\Modules\Listados\Models\Listado;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('listados::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' listados.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Listado();

        return view('listados::admin.create')
            ->with(compact('model'));
    }

    public function edit(listado $listado): View
    {
        return view('listados::admin.edit')
            ->with(['model' => $listado]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $listado = Listado::create($request->validated());

        return $this->redirect($request, $listado);
    }

    public function update(listado $listado, FormRequest $request): RedirectResponse
    {
        $listado->update($request->validated());

        return $this->redirect($request, $listado);
    }
}
