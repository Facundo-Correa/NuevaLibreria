<?php

namespace TypiCMS\Modules\Menuses\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Menuses\Composers\SidebarViewComposer;
use TypiCMS\Modules\Menuses\Facades\Menuses;
use TypiCMS\Modules\Menuses\Models\Menus;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.menuses');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.menuses' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'menuses');

        $this->publishes([
            __DIR__.'/../database/migrations/create_menuses_table.php.stub' => getMigrationFileName('create_menuses_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Menuses', Menuses::class);

        // Observers
        Menus::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('menuses::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('menuses');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Menuses', Menus::class);
    }
}
