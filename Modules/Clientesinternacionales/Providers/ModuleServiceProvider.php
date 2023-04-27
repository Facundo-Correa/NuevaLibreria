<?php

namespace TypiCMS\Modules\Clientesinternacionales\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Clientesinternacionales\Composers\SidebarViewComposer;
use TypiCMS\Modules\Clientesinternacionales\Facades\Clientesinternacionales;
use TypiCMS\Modules\Clientesinternacionales\Models\Clientesinternacionale;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.clientesinternacionales');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.clientesinternacionales' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'clientesinternacionales');

        $this->publishes([
            __DIR__.'/../database/migrations/create_clientesinternacionales_table.php.stub' => getMigrationFileName('create_clientesinternacionales_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Clientesinternacionales', Clientesinternacionales::class);

        // Observers
        Clientesinternacionale::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('clientesinternacionales::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('clientesinternacionales');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Clientesinternacionales', Clientesinternacionale::class);
    }
}
