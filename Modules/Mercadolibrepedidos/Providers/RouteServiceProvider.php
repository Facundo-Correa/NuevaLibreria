<?php

namespace TypiCMS\Modules\Mercadolibrepedidos\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Mercadolibrepedidos\Http\Controllers\AdminController;
use TypiCMS\Modules\Mercadolibrepedidos\Http\Controllers\ApiController;
use TypiCMS\Modules\Mercadolibrepedidos\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('mercadolibrepedidos')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-mercadolibrepedidos');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('mercadolibrepedido');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('mercadolibrepedidos', [AdminController::class, 'index'])->name('index-mercadolibrepedidos')->middleware('can:read mercadolibrepedidos');
            $router->get('mercadolibrepedidos/export', [AdminController::class, 'export'])->name('export-mercadolibrepedidos')->middleware('can:read mercadolibrepedidos');
            $router->get('mercadolibrepedidos/create', [AdminController::class, 'create'])->name('create-mercadolibrepedido')->middleware('can:create mercadolibrepedidos');
            $router->get('mercadolibrepedidos/{mercadolibrepedido}/edit', [AdminController::class, 'edit'])->name('edit-mercadolibrepedido')->middleware('can:read mercadolibrepedidos');
            $router->post('mercadolibrepedidos', [AdminController::class, 'store'])->name('store-mercadolibrepedido')->middleware('can:create mercadolibrepedidos');
            $router->put('mercadolibrepedidos/{mercadolibrepedido}', [AdminController::class, 'update'])->name('update-mercadolibrepedido')->middleware('can:update mercadolibrepedidos');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('mercadolibrepedidos', [ApiController::class, 'index'])->middleware('can:read mercadolibrepedidos');
            $router->patch('mercadolibrepedidos/{mercadolibrepedido}', [ApiController::class, 'updatePartial'])->middleware('can:update mercadolibrepedidos');
            $router->delete('mercadolibrepedidos/{mercadolibrepedido}', [ApiController::class, 'destroy'])->middleware('can:delete mercadolibrepedidos');
        });
    }
}
