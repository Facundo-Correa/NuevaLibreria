<?php

namespace TypiCMS\Modules\Carrusels\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Carrusels\Http\Controllers\AdminController;
use TypiCMS\Modules\Carrusels\Http\Controllers\ApiController;
use TypiCMS\Modules\Carrusels\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('carrusels')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-carrusels');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('carrusel');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->post('guardar-textos-carrusel', [AdminController::class, 'guardar_textos'])->name('index-carrusels')->middleware('can:read carrusels');
            
            
            $router->get('carrusels', [AdminController::class, 'index'])->name('index-carrusels')->middleware('can:read carrusels');
            $router->get('carrusels/export', [AdminController::class, 'export'])->name('export-carrusels')->middleware('can:read carrusels');
            $router->get('carrusels/create', [AdminController::class, 'create'])->name('create-carrusel')->middleware('can:create carrusels');
            $router->get('carrusels/{carrusel}/edit', [AdminController::class, 'edit'])->name('edit-carrusel')->middleware('can:read carrusels');
            $router->post('carrusels', [AdminController::class, 'store'])->name('store-carrusel')->middleware('can:create carrusels');
            $router->put('carrusels/{carrusel}', [AdminController::class, 'update'])->name('update-carrusel')->middleware('can:update carrusels');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('carrusels', [ApiController::class, 'index'])->middleware('can:read carrusels');
            $router->patch('carrusels/{carrusel}', [ApiController::class, 'updatePartial'])->middleware('can:update carrusels');
            $router->delete('carrusels/{carrusel}', [ApiController::class, 'destroy'])->middleware('can:delete carrusels');
        });
    }
}
