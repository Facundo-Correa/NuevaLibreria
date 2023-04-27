<?php

namespace TypiCMS\Modules\Mercadolibrepublicaciones\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read mercadolibrepublicaciones')) {
            return;
        }
        $view->sidebar->group(__('- Mercado Libre -'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Publicaciones'), function (SidebarItem $item) {
                $item->id = 'mercadolibrepublicaciones';
                $item->icon = config('typicms.mercadolibrepublicaciones.sidebar.icon');
                $item->weight = config('typicms.mercadolibrepublicaciones.sidebar.weight');
                $item->route('admin::index-mercadolibrepublicaciones');
                $item->append('admin::create-mercadolibrepublicacione');
            });
        });
    }
}
