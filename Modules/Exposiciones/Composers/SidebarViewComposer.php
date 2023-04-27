<?php

namespace TypiCMS\Modules\Exposiciones\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read exposiciones')) {
            return;
        }
        $view->sidebar->group(__('- Publicidades -'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Exposiciones'), function (SidebarItem $item) {
                $item->id = 'exposiciones';
                $item->icon = config('typicms.exposiciones.sidebar.icon');
                $item->weight = config('typicms.exposiciones.sidebar.weight');
                $item->route('admin::index-exposiciones');
                $item->append('admin::create-exposicione');
            });
        });
    }
}
