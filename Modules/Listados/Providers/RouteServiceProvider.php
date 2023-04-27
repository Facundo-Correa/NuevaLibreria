<?php

namespace TypiCMS\Modules\Listados\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Listados\Http\Controllers\AdminController;
use TypiCMS\Modules\Listados\Http\Controllers\ApiController;
use TypiCMS\Modules\Listados\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('listados')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-listados');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('listado');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('listados', [AdminController::class, 'index'])->name('index-listados')->middleware('can:read listados');
            $router->get('listados/export', [AdminController::class, 'export'])->name('export-listados')->middleware('can:read listados');
            $router->get('listados/create', [AdminController::class, 'create'])->name('create-listado')->middleware('can:create listados');
            $router->get('listados/{listado}/edit', [AdminController::class, 'edit'])->name('edit-listado')->middleware('can:read listados');
            $router->post('listados', [AdminController::class, 'store'])->name('store-listado')->middleware('can:create listados');
            $router->put('listados/{listado}', [AdminController::class, 'update'])->name('update-listado')->middleware('can:update listados');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('listados', [ApiController::class, 'index'])->middleware('can:read listados');
            $router->patch('listados/{listado}', [ApiController::class, 'updatePartial'])->middleware('can:update listados');
            $router->delete('listados/{listado}', [ApiController::class, 'destroy'])->middleware('can:delete listados');
        });
    }
}
