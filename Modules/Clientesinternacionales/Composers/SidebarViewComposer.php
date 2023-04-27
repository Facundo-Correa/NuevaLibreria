<?php

namespace TypiCMS\Modules\Clientesinternacionales\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read clientesinternacionales')) {
            return;
        }
        $view->sidebar->group(__('- Configuracion - '), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Clientes internacionales'), function (SidebarItem $item) {
                $item->id = 'clientes_internacionales';
                $item->icon = config('typicms.clientesinternacionales.sidebar.icon');
                $item->weight = config('typicms.clientesinternacionales.sidebar.weight');
                $item->route('admin::index-clientesinternacionales');
                $item->append('admin::create-clientesinternacionale');
            });
        });
    }
}
