<?php

namespace TypiCMS\Modules\Contadores\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read contadores')) {
            return;
        }
        $view->sidebar->group(__('- Configuracion - '), function (SidebarGroup $group) {
            $group->id = 'Configuracion';
            $group->weight = 30;
            $group->addItem(__('Contadores'), function (SidebarItem $item) {
                $item->id = 'contadores';
                $item->icon = config('typicms.contadores.sidebar.icon');
                $item->weight = config('typicms.contadores.sidebar.weight');
                $item->route('admin::index-contadores');
                $item->append('admin::create-contadore');
            });
        });
    }
}
