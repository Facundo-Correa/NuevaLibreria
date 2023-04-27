<?php

namespace TypiCMS\Modules\Categorias\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Categorias\Http\Controllers\AdminController;
use TypiCMS\Modules\Categorias\Http\Controllers\ApiController;
use TypiCMS\Modules\Categorias\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('categorias')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-categorias');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('categoria');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('categorias', [AdminController::class, 'index'])->name('index-categorias')->middleware('can:read categorias');
            $router->get('categorias/export', [AdminController::class, 'export'])->name('export-categorias')->middleware('can:read categorias');
            $router->get('categorias/create', [AdminController::class, 'create'])->name('create-categoria')->middleware('can:create categorias');
            $router->get('categorias/{categoria}/edit', [AdminController::class, 'edit'])->name('edit-categoria')->middleware('can:read categorias');
            $router->post('categorias', [AdminController::class, 'store'])->name('store-categoria')->middleware('can:create categorias');
            $router->put('categorias/{categoria}', [AdminController::class, 'update'])->name('update-categoria')->middleware('can:update categorias');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('categorias', [ApiController::class, 'index'])->middleware('can:read categorias');
            $router->patch('categorias/{categoria}', [ApiController::class, 'updatePartial'])->middleware('can:update categorias');
            $router->delete('categorias/{categoria}', [ApiController::class, 'destroy'])->middleware('can:delete categorias');
        });
    }
}
