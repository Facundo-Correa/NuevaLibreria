<?php

namespace TypiCMS\Modules\Mercadolibrepublicaciones\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Mercadolibrepublicaciones\Exports\Export;
use TypiCMS\Modules\Mercadolibrepublicaciones\Http\Requests\FormRequest;
use TypiCMS\Modules\Mercadolibrepublicaciones\Models\Mercadolibrepublicacione;

class AdminController extends BaseAdminController
{
    // public function index(): View
    // {
    //     return view('mercadolibrepublicaciones::admin.index');
    // }

    public function index($articulo , $pagina): View
    {   
        return view('mercadolibrepublicaciones::admin.index')
        ->with(['articulo' => $articulo])->with(['pagina' => $pagina]);
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' mercadolibrepublicaciones.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Mercadolibrepublicacione();

        return view('mercadolibrepublicaciones::admin.create')
            ->with(compact('model'));
    }

    public function edit(mercadolibrepublicacione $mercadolibrepublicacione): View
    {
        return view('mercadolibrepublicaciones::admin.edit')
            ->with(['model' => $mercadolibrepublicacione]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $mercadolibrepublicacione = Mercadolibrepublicacione::create($request->validated());

        return $this->redirect($request, $mercadolibrepublicacione);
    }

    public function update(mercadolibrepublicacione $mercadolibrepublicacione, FormRequest $request): RedirectResponse
    {
        $mercadolibrepublicacione->update($request->validated());

        return $this->redirect($request, $mercadolibrepublicacione);
    }
}
