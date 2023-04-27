<?php

namespace TypiCMS\Modules\Categories\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Categories\Composers\SidebarViewComposer;
use TypiCMS\Modules\Categories\Facades\Categories;
use TypiCMS\Modules\Categories\Models\Category;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.categories');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.categories' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'categories');

        $this->publishes([
            __DIR__.'/../database/migrations/create_categories_table.php.stub' => getMigrationFileName('create_categories_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Categories', Categories::class);

        // Observers
        Category::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('categories::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('categories');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Categories', Category::class);
    }
}
