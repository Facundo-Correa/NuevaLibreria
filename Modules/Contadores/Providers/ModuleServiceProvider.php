<?php

namespace TypiCMS\Modules\Contadores\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Contadores\Composers\SidebarViewComposer;
use TypiCMS\Modules\Contadores\Facades\Contadores;
use TypiCMS\Modules\Contadores\Models\Contadore;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.contadores');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.contadores' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'contadores');

        $this->publishes([
            __DIR__.'/../database/migrations/create_contadores_table.php.stub' => getMigrationFileName('create_contadores_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Contadores', Contadores::class);

        // Observers
        Contadore::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('contadores::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('contadores');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Contadores', Contadore::class);
    }
}
