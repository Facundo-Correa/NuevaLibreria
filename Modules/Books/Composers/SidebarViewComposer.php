<?php

namespace TypiCMS\Modules\Books\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read books')) {
            return;
        }
        $view->sidebar->group(__('- Libros -'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Libros Subidos'), function (SidebarItem $item) {
                $item->id = 'libros';
                $item->icon = config('typicms.books.sidebar.icon');
                $item->weight = config('typicms.books.sidebar.weight');
                $item->route('admin::index-books');
                $item->append('admin::create-book');
            });
        });
    }
}
