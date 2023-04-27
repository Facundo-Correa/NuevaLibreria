<?php

namespace TypiCMS\Modules\Categorias\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Categorias\Composers\SidebarViewComposer;
use TypiCMS\Modules\Categorias\Facades\Categorias;
use TypiCMS\Modules\Categorias\Models\Categoria;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.categorias');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.categorias' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'categorias');

        $this->publishes([
            __DIR__.'/../database/migrations/create_categorias_table.php.stub' => getMigrationFileName('create_categorias_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Categorias', Categorias::class);

        // Observers
        Categoria::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('categorias::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('categorias');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Categorias', Categoria::class);
    }
}
