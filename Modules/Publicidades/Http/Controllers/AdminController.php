<?php

namespace TypiCMS\Modules\Publicidades\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Publicidades\Exports\Export;
use TypiCMS\Modules\Publicidades\Http\Requests\FormRequest;
use TypiCMS\Modules\Publicidades\Models\Publicidade;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('publicidades::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' publicidades.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Publicidade();

        return view('publicidades::admin.create')
            ->with(compact('model'));
    }

    public function edit(publicidade $publicidade): View
    {
        return view('publicidades::admin.edit')
            ->with(['model' => $publicidade]);
    }

    public function store(FormRequest $request): RedirectResponse
    {   
        $publicidade = Publicidade::create($request->validated());
        
        return $this->redirect($request, $publicidade);
    }

    public function update(publicidade $publicidade, FormRequest $request): RedirectResponse
    {
        //dd($request);

        $publicidade->update($request->validated());
        //dd($publicidade);

        return $this->redirect($request, $publicidade);
    }
}
