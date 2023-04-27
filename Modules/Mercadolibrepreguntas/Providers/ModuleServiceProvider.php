<?php

namespace TypiCMS\Modules\Mercadolibrepreguntas\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Mercadolibrepreguntas\Composers\SidebarViewComposer;
use TypiCMS\Modules\Mercadolibrepreguntas\Facades\Mercadolibrepreguntas;
use TypiCMS\Modules\Mercadolibrepreguntas\Models\Mercadolibrepregunta;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.mercadolibrepreguntas');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.mercadolibrepreguntas' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'mercadolibrepreguntas');

        $this->publishes([
            __DIR__.'/../database/migrations/create_mercadolibrepreguntas_table.php.stub' => getMigrationFileName('create_mercadolibrepreguntas_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Mercadolibrepreguntas', Mercadolibrepreguntas::class);

        // Observers
        Mercadolibrepregunta::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('mercadolibrepreguntas::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('mercadolibrepreguntas');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Mercadolibrepreguntas', Mercadolibrepregunta::class);
    }
}
