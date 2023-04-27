<?php

namespace TypiCMS\Modules\Configuraciones\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read configuraciones')) {
            return;
        }
        $view->sidebar->group(__('- Configuracion - '), function (SidebarGroup $group) {
            $group->id = 'Configuracion';
            $group->weight = 30;
            $group->addItem(__('Configuraciones '), function (SidebarItem $item) {
                $item->id = 'configuraciones';
                $item->icon = config('typicms.configuraciones.sidebar.icon');
                $item->weight = config('typicms.configuraciones.sidebar.weight');
                $item->route('admin::index-configuraciones');
                $item->append('admin::create-configuracione');
            });
        });
    }
}
