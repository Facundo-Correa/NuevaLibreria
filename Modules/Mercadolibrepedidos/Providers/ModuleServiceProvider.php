<?php

namespace TypiCMS\Modules\Mercadolibrepedidos\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Mercadolibrepedidos\Composers\SidebarViewComposer;
use TypiCMS\Modules\Mercadolibrepedidos\Facades\Mercadolibrepedidos;
use TypiCMS\Modules\Mercadolibrepedidos\Models\Mercadolibrepedido;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.mercadolibrepedidos');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.mercadolibrepedidos' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'mercadolibrepedidos');

        $this->publishes([
            __DIR__.'/../database/migrations/create_mercadolibrepedidos_table.php.stub' => getMigrationFileName('create_mercadolibrepedidos_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Mercadolibrepedidos', Mercadolibrepedidos::class);

        // Observers
        Mercadolibrepedido::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('mercadolibrepedidos::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('mercadolibrepedidos');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Mercadolibrepedidos', Mercadolibrepedido::class);
    }
}
