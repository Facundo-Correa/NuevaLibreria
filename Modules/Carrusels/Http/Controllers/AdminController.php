<?php

namespace TypiCMS\Modules\Carrusels\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Carrusels\Exports\Export;
use TypiCMS\Modules\Carrusels\Http\Requests\FormRequest;
use TypiCMS\Modules\Carrusels\Models\Carrusel;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('carrusels::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' carrusels.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Carrusel();

        return view('carrusels::admin.create')
            ->with(compact('model'));
    }

    public function edit(carrusel $carrusel): View
    {
        return view('carrusels::admin.edit')
            ->with(['model' => $carrusel]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $carrusel = Carrusel::create($request->validated());

        return $this->redirect($request, $carrusel);
    }

    public function update(carrusel $carrusel, FormRequest $request): RedirectResponse
    {
        $carrusel->update($request->validated());

        return $this->redirect($request, $carrusel);
    }

    public function guardar_textos(Request $req){
        $id = $req->id;
        $textos = $req->textos;

        $modelo = Carrusel::where('id', $id)->first();
        $modelo->textos = $textos;
        $modelo->save();
        return $textos;
    }
}
