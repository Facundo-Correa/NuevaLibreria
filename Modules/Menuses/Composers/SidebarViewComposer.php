<?php

namespace TypiCMS\Modules\Menuses\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read menuses')) {
            return;
        }
        $view->sidebar->group(__('- Configuracion- '), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Menus'), function (SidebarItem $item) {
                $item->id = 'menuses';
                $item->icon = config('typicms.menuses.sidebar.icon');
                $item->weight = config('typicms.menuses.sidebar.weight');
                $item->route('admin::index-menuses');
                $item->append('admin::create-menus');
            });
        });
    }
}
