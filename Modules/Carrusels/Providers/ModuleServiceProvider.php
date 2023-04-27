<?php

namespace TypiCMS\Modules\Carrusels\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Carrusels\Composers\SidebarViewComposer;
use TypiCMS\Modules\Carrusels\Facades\Carrusels;
use TypiCMS\Modules\Carrusels\Models\Carrusel;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.carrusels');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.carrusels' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'carrusels');

        $this->publishes([
            __DIR__.'/../database/migrations/create_carrusels_table.php.stub' => getMigrationFileName('create_carrusels_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Carrusels', Carrusels::class);

        // Observers
        Carrusel::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('carrusels::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('carrusels');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Carrusels', Carrusel::class);
    }
}
