<?php

namespace TypiCMS\Modules\Inicios\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Inicios\Exports\Export;
use TypiCMS\Modules\Inicios\Http\Requests\FormRequest;
use TypiCMS\Modules\Inicios\Models\Inicio;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('inicios::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' inicios.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Inicio();

        return view('inicios::admin.create')
            ->with(compact('model'));
    }

    public function edit(inicio $inicio): View
    {
        return view('inicios::admin.edit')
            ->with(['model' => $inicio]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $inicio = Inicio::create($request->validated());

        return $this->redirect($request, $inicio);
    }

    public function update(inicio $inicio, FormRequest $request): RedirectResponse
    {
        $inicio->update($request->validated());

        return $this->redirect($request, $inicio);
    }
}
