<?php

namespace TypiCMS\Modules\Exposiciones\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Exposiciones\Composers\SidebarViewComposer;
use TypiCMS\Modules\Exposiciones\Facades\Exposiciones;
use TypiCMS\Modules\Exposiciones\Models\Exposicione;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.exposiciones');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.exposiciones' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'exposiciones');

        $this->publishes([
            __DIR__.'/../database/migrations/create_exposiciones_table.php.stub' => getMigrationFileName('create_exposiciones_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Exposiciones', Exposiciones::class);

        // Observers
        Exposicione::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('exposiciones::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('exposiciones');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Exposiciones', Exposicione::class);
    }
}
