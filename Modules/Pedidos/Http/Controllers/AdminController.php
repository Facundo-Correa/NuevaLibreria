<?php

namespace TypiCMS\Modules\Pedidos\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Pedidos\Exports\Export;
use TypiCMS\Modules\Pedidos\Http\Requests\FormRequest;
use TypiCMS\Modules\Pedidos\Models\Pedido;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('pedidos::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' pedidos.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Pedido();

        return view('pedidos::admin.create')
            ->with(compact('model'));
    }

    public function edit(pedido $pedido): View
    {
        return view('pedidos::admin.edit')
            ->with(['model' => $pedido]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $pedido = Pedido::create($request->validated());

        return $this->redirect($request, $pedido);
    }

    public function update(pedido $pedido, FormRequest $request): RedirectResponse
    {
        $pedido->update($request->validated());

        return $this->redirect($request, $pedido);
    }
}
