<?php

namespace TypiCMS\Modules\Booklists\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read booklists')) {
            return;
        }/*
        $view->sidebar->group(__('- Seccion - Libros -'), function (SidebarGroup $group) {
            $group->id = 'lists';
            $group->weight = 30;
            
            $group->addItem(__('Promos'), function (SidebarItem $item) {
                $item->id = 'promos';
                $item->icon = config('typicms.booklists.sidebar.icon');
                $item->weight = config('typicms.booklists.sidebar.weight');
                $item->route('admin::index-booklists-promos');
                $item->append('admin::create-booklists-promos');
            });
            $group->addItem(__('Publicidades'), function (SidebarItem $item) {
                $item->id = 'publicidades';
                $item->icon = config('typicms.booklists.sidebar.icon');
                $item->weight = config('typicms.booklists.sidebar.weight');
                $item->route('admin::index-booklists-publicidades');
                $item->append('admin::create-booklists-publicidades');
            });
            $group->addItem(__('Carouseles'), function (SidebarItem $item) {
                $item->id = 'carousels';
                $item->icon = config('typicms.booklists.sidebar.icon');
                $item->weight = config('typicms.booklists.sidebar.weight');
                $item->route('admin::index-booklists-carousels');
                $item->append('admin::create-booklists-carousels');
            });
        });*/
    }
}
