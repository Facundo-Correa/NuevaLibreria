<?php

namespace TypiCMS\Modules\Libros\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read libros')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Libros'), function (SidebarItem $item) {
                $item->id = 'libros';
                $item->icon = config('typicms.libros.sidebar.icon');
                $item->weight = config('typicms.libros.sidebar.weight');
                $item->route('admin::index-libros');
                $item->append('admin::create-libro');
            });
        });
    }
}
