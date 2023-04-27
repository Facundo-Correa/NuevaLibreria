<?php

namespace TypiCMS\Modules\Pedidos\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Pedidos\Http\Controllers\AdminController;
use TypiCMS\Modules\Pedidos\Http\Controllers\ApiController;
use TypiCMS\Modules\Pedidos\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('pedidos')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-pedidos');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('pedido');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('pedidos', [AdminController::class, 'index'])->name('index-pedidos')->middleware('can:read pedidos');
            $router->get('pedidos/export', [AdminController::class, 'export'])->name('export-pedidos')->middleware('can:read pedidos');
            $router->get('pedidos/create', [AdminController::class, 'create'])->name('create-pedido')->middleware('can:create pedidos');
            $router->get('pedidos/{pedido}/edit', [AdminController::class, 'edit'])->name('edit-pedido')->middleware('can:read pedidos');
            $router->post('pedidos', [AdminController::class, 'store'])->name('store-pedido')->middleware('can:create pedidos');
            $router->put('pedidos/{pedido}', [AdminController::class, 'update'])->name('update-pedido')->middleware('can:update pedidos');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('pedidos', [ApiController::class, 'index'])->middleware('can:read pedidos');
            $router->patch('pedidos/{pedido}', [ApiController::class, 'updatePartial'])->middleware('can:update pedidos');
            $router->delete('pedidos/{pedido}', [ApiController::class, 'destroy'])->middleware('can:delete pedidos');
        });
    }
}
