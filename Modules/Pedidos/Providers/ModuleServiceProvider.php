<?php

namespace TypiCMS\Modules\Pedidos\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Pedidos\Composers\SidebarViewComposer;
use TypiCMS\Modules\Pedidos\Facades\Pedidos;
use TypiCMS\Modules\Pedidos\Models\Pedido;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.pedidos');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.pedidos' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'pedidos');

        $this->publishes([
            __DIR__.'/../database/migrations/create_pedidos_table.php.stub' => getMigrationFileName('create_pedidos_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Pedidos', Pedidos::class);

        // Observers
        Pedido::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('pedidos::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('pedidos');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Pedidos', Pedido::class);
    }
}
