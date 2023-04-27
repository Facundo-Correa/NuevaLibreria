<?php

namespace TypiCMS\Modules\Publicidades\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read publicidades')) {
            return;
        }
        $view->sidebar->group(__('- Publicidades -'), function (SidebarGroup $group) {
            $group->id = 'publicidades';
            $group->weight = 30;
            $group->addItem(__('Publicidades '), function (SidebarItem $item) {
                $item->id = 'publicidades';
                $item->icon = config('typicms.publicidades.sidebar.icon');
                $item->weight = config('typicms.publicidades.sidebar.weight');
                $item->route('admin::index-publicidades');
                $item->append('admin::create-publicidade');
            });
        });
    }
}
