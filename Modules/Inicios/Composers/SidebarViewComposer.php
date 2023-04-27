<?php

namespace TypiCMS\Modules\Inicios\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read inicios')) {
            return;
        }
        $view->sidebar->group(__('- Seccion - Home -'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;

           
        });
    }
}
