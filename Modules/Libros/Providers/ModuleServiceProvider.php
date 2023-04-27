<?php

namespace TypiCMS\Modules\Libros\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Libros\Composers\SidebarViewComposer;
use TypiCMS\Modules\Libros\Facades\Libros;
use TypiCMS\Modules\Libros\Models\Libro;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.libros');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.libros' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'libros');

        $this->publishes([
            __DIR__.'/../database/migrations/create_libros_table.php.stub' => getMigrationFileName('create_libros_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Libros', Libros::class);

        // Observers
        Libro::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('libros::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('libros');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Libros', Libro::class);
    }
}
