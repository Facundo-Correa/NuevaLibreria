<?php

namespace TypiCMS\Modules\Buscars\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Buscars\Composers\SidebarViewComposer;
use TypiCMS\Modules\Buscars\Facades\Buscars;
use TypiCMS\Modules\Buscars\Models\Buscar;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.buscars');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.buscars' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'buscars');

        $this->publishes([
            __DIR__.'/../database/migrations/create_buscars_table.php.stub' => getMigrationFileName('create_buscars_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Buscars', Buscars::class);

        // Observers
        Buscar::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('buscars::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('buscars');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Buscars', Buscar::class);
    }
}
