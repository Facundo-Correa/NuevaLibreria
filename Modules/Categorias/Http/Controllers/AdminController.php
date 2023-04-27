<?php

namespace TypiCMS\Modules\Categorias\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Categorias\Exports\Export;
use TypiCMS\Modules\Categorias\Http\Requests\FormRequest;
use TypiCMS\Modules\Categorias\Models\Categoria;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('categorias::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' categorias.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Categoria();

        return view('categorias::admin.create')
            ->with(compact('model'));
    }

    public function edit(categoria $categoria): View
    {
        return view('categorias::admin.edit')
            ->with(['model' => $categoria]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $categoria = Categoria::create($request->validated());

        return $this->redirect($request, $categoria);
    }

    public function update(categoria $categoria, FormRequest $request): RedirectResponse
    {
        $categoria->update($request->validated());

        return $this->redirect($request, $categoria);
    }
}
