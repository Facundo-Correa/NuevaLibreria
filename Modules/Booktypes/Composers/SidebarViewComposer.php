<?php

namespace TypiCMS\Modules\Booktypes\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read booktypes') || config('typicms.bookauthors.sidebar.show') === false) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Booktypes'), function (SidebarItem $item) {
                $item->id = 'booktypes';
                $item->icon = config('typicms.booktypes.sidebar.icon');
                $item->weight = config('typicms.booktypes.sidebar.weight');
                $item->route('admin::index-booktypes');
                $item->append('admin::create-booktype');
            });
        });
    }
}
