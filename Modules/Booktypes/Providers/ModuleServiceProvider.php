<?php

namespace TypiCMS\Modules\Booktypes\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Booktypes\Composers\SidebarViewComposer;
use TypiCMS\Modules\Booktypes\Facades\Booktypes;
use TypiCMS\Modules\Booktypes\Models\Booktype;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.booktypes');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.booktypes' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'booktypes');

        $this->publishes([
            __DIR__.'/../database/migrations/create_booktypes_table.php.stub' => getMigrationFileName('create_booktypes_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Booktypes', Booktypes::class);

        // Observers
        Booktype::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('booktypes::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('booktypes');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Booktypes', Booktype::class);
    }
}
