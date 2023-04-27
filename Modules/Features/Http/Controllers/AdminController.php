<?php

namespace TypiCMS\Modules\Features\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Features\Exports\Export;
use TypiCMS\Modules\Features\Http\Requests\FormRequest;
use TypiCMS\Modules\Features\Models\Feature;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('features::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' features.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Feature();

        return view('features::admin.create')
            ->with(compact('model'));
    }

    public function edit(feature $feature): View
    {
        return view('features::admin.edit')
            ->with(['model' => $feature]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $feature = Feature::create($request->validated());

        return $this->redirect($request, $feature);
    }

    public function update(feature $feature, FormRequest $request): RedirectResponse
    {
        $feature->update($request->validated());

        return $this->redirect($request, $feature);
    }
}
