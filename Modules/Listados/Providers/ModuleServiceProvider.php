<?php

namespace TypiCMS\Modules\Listados\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Listados\Composers\SidebarViewComposer;
use TypiCMS\Modules\Listados\Facades\Listados;
use TypiCMS\Modules\Listados\Models\Listado;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.listados');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.listados' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'listados');

        $this->publishes([
            __DIR__.'/../database/migrations/create_listados_table.php.stub' => getMigrationFileName('create_listados_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Listados', Listados::class);

        // Observers
        Listado::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('listados::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('listados');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Listados', Listado::class);
    }
}
