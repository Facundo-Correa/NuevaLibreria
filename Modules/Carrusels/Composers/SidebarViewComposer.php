<?php

namespace TypiCMS\Modules\Carrusels\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read carrusels')) {
            return;
        }
        $view->sidebar->group(__('- Publicidades -'), function (SidebarGroup $group) {
            $group->id = 'publicidades';
            $group->weight = 30;
            $group->addItem(__('Carruseles'), function (SidebarItem $item) {
                $item->id = 'carrusels';
                $item->icon = config('typicms.carrusels.sidebar.icon');
                $item->weight = config('typicms.carrusels.sidebar.weight');
                $item->route('admin::index-carrusels');
                $item->append('admin::create-carrusel');
            });
        });
    }
}
