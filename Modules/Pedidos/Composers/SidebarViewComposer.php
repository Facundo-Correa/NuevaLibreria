<?php

namespace TypiCMS\Modules\Pedidos\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read pedidos')) {
            return;
        }
        $view->sidebar->group(__('- Compras en la página -'), function (SidebarGroup $group) {
            $group->id = 'cep';
            $group->weight = 30;
            $group->addItem(__('Pedidos'), function (SidebarItem $item) {
                $item->id = 'pedidos';
                $item->icon = config('typicms.pedidos.sidebar.icon');
                $item->weight = config('typicms.pedidos.sidebar.weight');
                $item->route('admin::index-pedidos');
                $item->append('admin::create-pedido');
            });
        });
    }
}
