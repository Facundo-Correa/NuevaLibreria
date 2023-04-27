<?php

namespace TypiCMS\Modules\Clientesinternacionales\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Clientesinternacionales\Http\Controllers\AdminController;
use TypiCMS\Modules\Clientesinternacionales\Http\Controllers\ApiController;
use TypiCMS\Modules\Clientesinternacionales\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('clientesinternacionales')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-clientesinternacionales');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('clientesinternacionale');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('clientesinternacionales', [AdminController::class, 'index'])->name('index-clientesinternacionales')->middleware('can:read clientesinternacionales');
            $router->get('clientesinternacionales/export', [AdminController::class, 'export'])->name('export-clientesinternacionales')->middleware('can:read clientesinternacionales');
            $router->get('clientesinternacionales/create', [AdminController::class, 'create'])->name('create-clientesinternacionale')->middleware('can:create clientesinternacionales');
            $router->get('clientesinternacionales/{clientesinternacionale}/edit', [AdminController::class, 'edit'])->name('edit-clientesinternacionale')->middleware('can:read clientesinternacionales');
            $router->post('clientesinternacionales', [AdminController::class, 'store'])->name('store-clientesinternacionale')->middleware('can:create clientesinternacionales');
            $router->put('clientesinternacionales/{clientesinternacionale}', [AdminController::class, 'update'])->name('update-clientesinternacionale')->middleware('can:update clientesinternacionales');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('clientesinternacionales', [ApiController::class, 'index'])->middleware('can:read clientesinternacionales');
            $router->patch('clientesinternacionales/{clientesinternacionale}', [ApiController::class, 'updatePartial'])->middleware('can:update clientesinternacionales');
            $router->delete('clientesinternacionales/{clientesinternacionale}', [ApiController::class, 'destroy'])->middleware('can:delete clientesinternacionales');
        });
    }
}
