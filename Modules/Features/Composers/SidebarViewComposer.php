<?php

namespace TypiCMS\Modules\Features\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read features')) {
            return;
        }
        $view->sidebar->group(__('- Features -'), function (SidebarGroup $group) {
            $group->id = 'features';
            $group->weight = 30;
            $group->addItem(__('Features'), function (SidebarItem $item) {
                $item->id = 'features';
                $item->icon = config('typicms.features.sidebar.icon');
                $item->weight = config('typicms.features.sidebar.weight');
                $item->route('admin::index-features');
                $item->append('admin::create-feature');
            });
        });
    }
}
