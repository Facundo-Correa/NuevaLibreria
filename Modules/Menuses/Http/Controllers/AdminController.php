<?php

namespace TypiCMS\Modules\Menuses\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Menuses\Exports\Export;
use TypiCMS\Modules\Menuses\Http\Requests\FormRequest;
use TypiCMS\Modules\Menuses\Models\Menus;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('menuses::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' menuses.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Menus();

        return view('menuses::admin.create')
            ->with(compact('model'));
    }

    public function edit(menus $menus): View
    {
        return view('menuses::admin.edit')
            ->with(['model' => $menus]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $menus = Menus::create($request->validated());

        return $this->redirect($request, $menus);
    }

    public function update(menus $menus, FormRequest $request): RedirectResponse
    {
        $menus->update($request->validated());

        return $this->redirect($request, $menus);
    }
}
