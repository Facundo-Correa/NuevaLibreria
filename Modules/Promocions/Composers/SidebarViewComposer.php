<?php

namespace TypiCMS\Modules\Promocions\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read promocions')) {
            return;
        }
        $view->sidebar->group(__('- Publicidades -'), function (SidebarGroup $group) {
            $group->id = 'publicidades';
            $group->weight = 30;
            $group->addItem(__('Promociones'), function (SidebarItem $item) {
                $item->id = 'promocions';
                $item->icon = config('typicms.promocions.sidebar.icon');
                $item->weight = config('typicms.promocions.sidebar.weight');
                $item->route('admin::index-promocions');
                $item->append('admin::create-promocion');
            });
        });
    }
}
