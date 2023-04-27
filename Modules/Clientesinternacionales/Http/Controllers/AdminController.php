<?php

namespace TypiCMS\Modules\Clientesinternacionales\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Clientesinternacionales\Exports\Export;
use TypiCMS\Modules\Clientesinternacionales\Http\Requests\FormRequest;
use TypiCMS\Modules\Clientesinternacionales\Models\Clientesinternacionale;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('clientesinternacionales::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' clientesinternacionales.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Clientesinternacionale();

        return view('clientesinternacionales::admin.create')
            ->with(compact('model'));
    }

    public function edit(clientesinternacionale $clientesinternacionale): View
    {
        return view('clientesinternacionales::admin.edit')
            ->with(['model' => $clientesinternacionale]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $clientesinternacionale = Clientesinternacionale::create($request->validated());

        return $this->redirect($request, $clientesinternacionale);
    }

    public function update(clientesinternacionale $clientesinternacionale, FormRequest $request): RedirectResponse
    {
        $clientesinternacionale->update($request->validated());

        return $this->redirect($request, $clientesinternacionale);
    }
}
