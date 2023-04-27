<?php

namespace TypiCMS\Modules\Books\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Books\Composers\SidebarViewComposer;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'typicms.books');
        $this->mergeConfigFrom(__DIR__ . '/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.books' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'books');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_books_table.php.stub' => getMigrationFileName('create_books_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Books', Books::class);

        // Observers
        // Book::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('books::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('books');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Books', Book::class);
    }
}
