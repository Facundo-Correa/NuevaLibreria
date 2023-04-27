<?php

namespace TypiCMS\Modules\Features\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Features\Composers\SidebarViewComposer;
use TypiCMS\Modules\Features\Facades\Features;
use TypiCMS\Modules\Features\Models\Feature;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.features');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.features' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'features');

        $this->publishes([
            __DIR__.'/../database/migrations/create_features_table.php.stub' => getMigrationFileName('create_features_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Features', Features::class);

        // Observers
        Feature::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('features::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('features');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Features', Feature::class);
    }
}
