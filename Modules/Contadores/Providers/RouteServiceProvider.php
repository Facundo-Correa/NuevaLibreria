<?php

namespace TypiCMS\Modules\Contadores\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Contadores\Http\Controllers\AdminController;
use TypiCMS\Modules\Contadores\Http\Controllers\ApiController;
use TypiCMS\Modules\Contadores\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('contadores')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-contadores');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('contadore');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('contadores', [AdminController::class, 'index'])->name('index-contadores')->middleware('can:read contadores');
            $router->get('contadores/export', [AdminController::class, 'export'])->name('export-contadores')->middleware('can:read contadores');
            $router->get('contadores/create', [AdminController::class, 'create'])->name('create-contadore')->middleware('can:create contadores');
            $router->get('contadores/{contadore}/edit', [AdminController::class, 'edit'])->name('edit-contadore')->middleware('can:read contadores');
            $router->post('contadores', [AdminController::class, 'store'])->name('store-contadore')->middleware('can:create contadores');
            $router->put('contadores/{contadore}', [AdminController::class, 'update'])->name('update-contadore')->middleware('can:update contadores');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('contadores', [ApiController::class, 'index'])->middleware('can:read contadores');
            $router->patch('contadores/{contadore}', [ApiController::class, 'updatePartial'])->middleware('can:update contadores');
            $router->delete('contadores/{contadore}', [ApiController::class, 'destroy'])->middleware('can:delete contadores');
        });
    }
}
