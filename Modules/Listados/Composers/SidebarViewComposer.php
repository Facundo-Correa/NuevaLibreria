<?php

namespace TypiCMS\Modules\Listados\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read listados')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Listados'), function (SidebarItem $item) {
                $item->id = 'listados';
                $item->icon = config('typicms.listados.sidebar.icon');
                $item->weight = config('typicms.listados.sidebar.weight');
                $item->route('admin::index-listados');
                $item->append('admin::create-listado');
            });
        });
    }
}
