<?php

namespace TypiCMS\Modules\Buscars\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read buscars')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Buscars'), function (SidebarItem $item) {
                $item->id = 'buscars';
                $item->icon = config('typicms.buscars.sidebar.icon');
                $item->weight = config('typicms.buscars.sidebar.weight');
                $item->route('admin::index-buscars');
                $item->append('admin::create-buscar');
            });
        });
    }
}
