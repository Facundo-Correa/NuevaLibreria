<?php

namespace TypiCMS\Modules\Mercadolibrepreguntas\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read mercadolibrepreguntas')) {
            return;
        }
        $view->sidebar->group(__('- Mercado Libre -'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Preguntas'), function (SidebarItem $item) {
                $item->id = 'mercadolibrepreguntas';
                $item->icon = config('typicms.mercadolibrepreguntas.sidebar.icon');
                $item->weight = config('typicms.mercadolibrepreguntas.sidebar.weight');
                $item->route('admin::index-mercadolibrepreguntas');
                $item->append('admin::create-mercadolibrepregunta');
            });
        });
    }
}
