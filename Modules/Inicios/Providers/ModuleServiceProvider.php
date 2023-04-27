<?php

namespace TypiCMS\Modules\Inicios\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Inicios\Composers\SidebarViewComposer;
use TypiCMS\Modules\Inicios\Facades\Inicios;
use TypiCMS\Modules\Inicios\Models\Inicio;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.inicios');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.inicios' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'inicios');

        $this->publishes([
            __DIR__.'/../database/migrations/create_inicios_table.php.stub' => getMigrationFileName('create_inicios_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Inicios', Inicios::class);

        // Observers
        Inicio::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('inicios::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('inicios');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Inicios', Inicio::class);
    }
}
