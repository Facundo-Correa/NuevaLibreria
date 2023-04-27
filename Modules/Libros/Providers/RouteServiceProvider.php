<?php

namespace TypiCMS\Modules\Libros\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Libros\Http\Controllers\AdminController;
use TypiCMS\Modules\Libros\Http\Controllers\ApiController;
use TypiCMS\Modules\Libros\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('libros')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-libros');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('libro');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('libros', [AdminController::class, 'index'])->name('index-libros')->middleware('can:read libros');
            $router->get('libros/export', [AdminController::class, 'export'])->name('export-libros')->middleware('can:read libros');
            $router->get('libros/create', [AdminController::class, 'create'])->name('create-libro')->middleware('can:create libros');
            $router->get('libros/{libro}/edit', [AdminController::class, 'edit'])->name('edit-libro')->middleware('can:read libros');
            $router->post('libros', [AdminController::class, 'store'])->name('store-libro')->middleware('can:create libros');
            $router->put('libros/{libro}', [AdminController::class, 'update'])->name('update-libro')->middleware('can:update libros');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('libros', [ApiController::class, 'index'])->middleware('can:read libros');
            $router->patch('libros/{libro}', [ApiController::class, 'updatePartial'])->middleware('can:update libros');
            $router->delete('libros/{libro}', [ApiController::class, 'destroy'])->middleware('can:delete libros');
        });
    }
}
