<?php

namespace TypiCMS\Modules\Preguntas\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Preguntas\Exports\Export;
use TypiCMS\Modules\Preguntas\Http\Requests\FormRequest;
use TypiCMS\Modules\Preguntas\Models\Pregunta;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('preguntas::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' preguntas.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Pregunta();

        return view('preguntas::admin.create')
            ->with(compact('model'));
    }

    public function edit(pregunta $pregunta): View
    {
        return view('preguntas::admin.edit')
            ->with(['model' => $pregunta]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $pregunta = Pregunta::create($request->validated());

        return $this->redirect($request, $pregunta);
    }

    public function update(pregunta $pregunta, FormRequest $request): RedirectResponse
    {
        $pregunta->update($request->validated());

        return $this->redirect($request, $pregunta);
    }
}
