<?php

namespace TypiCMS\Modules\Mercadolibrepedidos\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Mercadolibrepedidos\Exports\Export;
use TypiCMS\Modules\Mercadolibrepedidos\Http\Requests\FormRequest;
use TypiCMS\Modules\Mercadolibrepedidos\Models\Mercadolibrepedido;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('mercadolibrepedidos::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' mercadolibrepedidos.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Mercadolibrepedido();

        return view('mercadolibrepedidos::admin.create')
            ->with(compact('model'));
    }

    public function edit(mercadolibrepedido $mercadolibrepedido): View
    {
        return view('mercadolibrepedidos::admin.edit')
            ->with(['model' => $mercadolibrepedido]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $mercadolibrepedido = Mercadolibrepedido::create($request->validated());

        return $this->redirect($request, $mercadolibrepedido);
    }

    public function update(mercadolibrepedido $mercadolibrepedido, FormRequest $request): RedirectResponse
    {
        $mercadolibrepedido->update($request->validated());

        return $this->redirect($request, $mercadolibrepedido);
    }
}
