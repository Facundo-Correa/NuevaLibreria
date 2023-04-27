<?php

namespace TypiCMS\Modules\Booklists\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Booklists\Composers\SidebarViewComposer;
use TypiCMS\Modules\Booklists\Facades\Booklists;
use TypiCMS\Modules\Booklists\Models\Booklist;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'typicms.booklists');
        $this->mergeConfigFrom(__DIR__ . '/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.booklists' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'booklists');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_booklists_table.php.stub' => getMigrationFileName('create_booklists_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Booklists', Booklists::class);

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('booklists::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('booklists');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Booklists', Booklist::class);
    }
}
