<?php

namespace TypiCMS\Modules\Categorias\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read categorias')) {
            return;
        }/*
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Categorias'), function (SidebarItem $item) {
                $item->id = 'categorias';
                $item->icon = config('typicms.categorias.sidebar.icon');
                $item->weight = config('typicms.categorias.sidebar.weight');
                $item->route('admin::index-categorias');
                $item->append('admin::create-categoria');
            });
        });*/
    }
}
