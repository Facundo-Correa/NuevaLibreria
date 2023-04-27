<?php

namespace TypiCMS\Modules\Libros\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Libros\Exports\Export;
use TypiCMS\Modules\Libros\Http\Requests\FormRequest;
use TypiCMS\Modules\Libros\Models\Libro;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('libros::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' libros.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Libro();

        return view('libros::admin.create')
            ->with(compact('model'));
    }

    public function edit(libro $libro): View
    {
        return view('libros::admin.edit')
            ->with(['model' => $libro]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $libro = Libro::create($request->validated());

        return $this->redirect($request, $libro);
    }

    public function update(libro $libro, FormRequest $request): RedirectResponse
    {
        $libro->update($request->validated());

        return $this->redirect($request, $libro);
    }
}
