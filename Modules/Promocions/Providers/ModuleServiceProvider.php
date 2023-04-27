<?php

namespace TypiCMS\Modules\Promocions\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Promocions\Composers\SidebarViewComposer;
use TypiCMS\Modules\Promocions\Facades\Promocions;
use TypiCMS\Modules\Promocions\Models\Promocion;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.promocions');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.promocions' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'promocions');

        $this->publishes([
            __DIR__.'/../database/migrations/create_promocions_table.php.stub' => getMigrationFileName('create_promocions_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Promocions', Promocions::class);

        // Observers
        Promocion::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('promocions::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('promocions');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Promocions', Promocion::class);
    }
}
