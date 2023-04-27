<?php

namespace TypiCMS\Modules\Mercadolibrepublicaciones\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Mercadolibrepublicaciones\Composers\SidebarViewComposer;
use TypiCMS\Modules\Mercadolibrepublicaciones\Facades\Mercadolibrepublicaciones;
use TypiCMS\Modules\Mercadolibrepublicaciones\Models\Mercadolibrepublicacione;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.mercadolibrepublicaciones');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.mercadolibrepublicaciones' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'mercadolibrepublicaciones');

        $this->publishes([
            __DIR__.'/../database/migrations/create_mercadolibrepublicaciones_table.php.stub' => getMigrationFileName('create_mercadolibrepublicaciones_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Mercadolibrepublicaciones', Mercadolibrepublicaciones::class);

        // Observers
        Mercadolibrepublicacione::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('mercadolibrepublicaciones::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('mercadolibrepublicaciones');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Mercadolibrepublicaciones', Mercadolibrepublicacione::class);
    }
}
