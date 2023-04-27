<?php

namespace TypiCMS\Modules\Preguntas\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read preguntas')) {
            return;
        }
        $view->sidebar->group(__('- Compras en la página -'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Preguntas'), function (SidebarItem $item) {
                $item->id = 'preguntas';
                $item->icon = config('typicms.preguntas.sidebar.icon');
                $item->weight = config('typicms.preguntas.sidebar.weight');
                $item->route('admin::index-preguntas');
                $item->append('admin::create-pregunta');
            });
        });
    }
}
