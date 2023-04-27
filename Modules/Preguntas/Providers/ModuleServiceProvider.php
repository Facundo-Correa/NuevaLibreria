<?php

namespace TypiCMS\Modules\Preguntas\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Preguntas\Composers\SidebarViewComposer;
use TypiCMS\Modules\Preguntas\Facades\Preguntas;
use TypiCMS\Modules\Preguntas\Models\Pregunta;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.preguntas');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        config(['typicms.modules.preguntas' => ['linkable_to_page']]);

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'preguntas');

        $this->publishes([
            __DIR__.'/../database/migrations/create_preguntas_table.php.stub' => getMigrationFileName('create_preguntas_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Preguntas', Preguntas::class);

        // Observers
        Pregunta::observe(new SlugObserver());

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('preguntas::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('preguntas');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Preguntas', Pregunta::class);
    }
}
