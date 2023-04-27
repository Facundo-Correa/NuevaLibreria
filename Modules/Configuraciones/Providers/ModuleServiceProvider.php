<?php

namespace TypiCMS\Modules\Configuraciones\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Configuraciones\Composers\SidebarViewComposer;
use TypiCMS\Modules\Configuraciones\Facades\Configuraciones;
use TypiCMS\Modules\Configuraciones\Models\Configuracione;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.configuraciones');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.configuraciones' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'configuraciones');

        $this->publishes([
            __DIR__.'/../database/migrations/create_configuraciones_table.php.stub' => getMigrationFileName('create_configuraciones_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Configuraciones', Configuraciones::class);

        // Observers
        Configuracione::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('configuraciones::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('configuraciones');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Configuraciones', Configuracione::class);
    }
}
