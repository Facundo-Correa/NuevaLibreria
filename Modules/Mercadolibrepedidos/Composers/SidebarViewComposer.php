<?php

namespace TypiCMS\Modules\Mercadolibrepedidos\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read mercadolibrepedidos')) {
            return;
        }
        $view->sidebar->group(__('- Mercado Libre -'), function (SidebarGroup $group) {
            $group->id = 'mercadoLibre';
            $group->weight = 30;
            $group->addItem(__('Pedidos'), function (SidebarItem $item) {
                $item->id = 'mercadolibrepedidos';
                $item->icon = config('typicms.mercadolibrepedidos.sidebar.icon');
                $item->weight = config('typicms.mercadolibrepedidos.sidebar.weight');
                $item->route('admin::index-mercadolibrepedidos');
                $item->append('admin::create-mercadolibrepedido');
            });
        });
    }
}
