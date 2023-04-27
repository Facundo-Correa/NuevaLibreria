<?php

namespace TypiCMS\Modules\Configuraciones\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Configuraciones\Http\Controllers\AdminController;
use TypiCMS\Modules\Configuraciones\Http\Controllers\ApiController;
use TypiCMS\Modules\Configuraciones\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('configuraciones')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-configuraciones');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('configuracione');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('configuraciones', [AdminController::class, 'index'])->name('index-configuraciones')->middleware('can:read configuraciones');
            $router->get('configuraciones/export', [AdminController::class, 'export'])->name('export-configuraciones')->middleware('can:read configuraciones');
            $router->get('configuraciones/create', [AdminController::class, 'create'])->name('create-configuracione')->middleware('can:create configuraciones');
            $router->get('configuraciones/{configuracione}/edit', [AdminController::class, 'edit'])->name('edit-configuracione')->middleware('can:read configuraciones');
            $router->post('configuraciones', [AdminController::class, 'store'])->name('store-configuracione')->middleware('can:create configuraciones');
            $router->put('configuraciones/{configuracione}', [AdminController::class, 'update'])->name('update-configuracione')->middleware('can:update configuraciones');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('configuraciones', [ApiController::class, 'index'])->middleware('can:read configuraciones');
            $router->patch('configuraciones/{configuracione}', [ApiController::class, 'updatePartial'])->middleware('can:update configuraciones');
            $router->delete('configuraciones/{configuracione}', [ApiController::class, 'destroy'])->middleware('can:delete configuraciones');
        });
    }
}
