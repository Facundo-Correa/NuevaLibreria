<?php

namespace TypiCMS\Modules\Configuraciones\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Configuraciones\Exports\Export;
use TypiCMS\Modules\Configuraciones\Http\Requests\FormRequest;
use TypiCMS\Modules\Configuraciones\Models\Configuracione;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('configuraciones::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' configuraciones.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Configuracione();

        return view('configuraciones::admin.create')
            ->with(compact('model'));
    }

    public function edit(configuracione $configuracione): View
    {
        return view('configuraciones::admin.edit')
            ->with(['model' => $configuracione]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $configuracione = Configuracione::create($request->validated());

        return $this->redirect($request, $configuracione);
    }

    public function update(configuracione $configuracione, FormRequest $request): RedirectResponse
    {
        $configuracione->update($request->validated());

        return $this->redirect($request, $configuracione);
    }
}
