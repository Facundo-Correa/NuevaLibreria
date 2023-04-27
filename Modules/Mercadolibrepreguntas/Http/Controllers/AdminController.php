<?php

namespace TypiCMS\Modules\Mercadolibrepreguntas\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Mercadolibrepreguntas\Exports\Export;
use TypiCMS\Modules\Mercadolibrepreguntas\Http\Requests\FormRequest;
use TypiCMS\Modules\Mercadolibrepreguntas\Models\Mercadolibrepregunta;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('mercadolibrepreguntas::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' mercadolibrepreguntas.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Mercadolibrepregunta();

        return view('mercadolibrepreguntas::admin.create')
            ->with(compact('model'));
    }

    public function edit(mercadolibrepregunta $mercadolibrepregunta): View
    {
        return view('mercadolibrepreguntas::admin.edit')
            ->with(['model' => $mercadolibrepregunta]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $mercadolibrepregunta = Mercadolibrepregunta::create($request->validated());

        return $this->redirect($request, $mercadolibrepregunta);
    }

    public function update(mercadolibrepregunta $mercadolibrepregunta, FormRequest $request): RedirectResponse
    {
        $mercadolibrepregunta->update($request->validated());

        return $this->redirect($request, $mercadolibrepregunta);
    }
}
