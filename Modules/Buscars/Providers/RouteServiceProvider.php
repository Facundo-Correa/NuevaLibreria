<?php

namespace TypiCMS\Modules\Buscars\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Buscars\Http\Controllers\AdminController;
use TypiCMS\Modules\Buscars\Http\Controllers\ApiController;
use TypiCMS\Modules\Buscars\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('buscars')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-buscars');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('buscar');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('buscars', [AdminController::class, 'index'])->name('index-buscars')->middleware('can:read buscars');
            $router->get('buscars/export', [AdminController::class, 'export'])->name('export-buscars')->middleware('can:read buscars');
            $router->get('buscars/create', [AdminController::class, 'create'])->name('create-buscar')->middleware('can:create buscars');
            $router->get('buscars/{buscar}/edit', [AdminController::class, 'edit'])->name('edit-buscar')->middleware('can:read buscars');
            $router->post('buscars', [AdminController::class, 'store'])->name('store-buscar')->middleware('can:create buscars');
            $router->put('buscars/{buscar}', [AdminController::class, 'update'])->name('update-buscar')->middleware('can:update buscars');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('buscars', [ApiController::class, 'index'])->middleware('can:read buscars');
            $router->patch('buscars/{buscar}', [ApiController::class, 'updatePartial'])->middleware('can:update buscars');
            $router->delete('buscars/{buscar}', [ApiController::class, 'destroy'])->middleware('can:delete buscars');
        });
    }
}
