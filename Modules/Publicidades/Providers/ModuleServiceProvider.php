<?php

namespace TypiCMS\Modules\Publicidades\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Publicidades\Composers\SidebarViewComposer;
use TypiCMS\Modules\Publicidades\Facades\Publicidades;
use TypiCMS\Modules\Publicidades\Models\Publicidade;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.publicidades');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.publicidades' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'publicidades');

        $this->publishes([
            __DIR__.'/../database/migrations/create_publicidades_table.php.stub' => getMigrationFileName('create_publicidades_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Publicidades', Publicidades::class);

        // Observers
        Publicidade::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('publicidades::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('publicidades');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Publicidades', Publicidade::class);
    }
}
