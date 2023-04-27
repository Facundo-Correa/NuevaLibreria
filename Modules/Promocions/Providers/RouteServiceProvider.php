<?php

namespace TypiCMS\Modules\Promocions\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Promocions\Http\Controllers\AdminController;
use TypiCMS\Modules\Promocions\Http\Controllers\ApiController;
use TypiCMS\Modules\Promocions\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('promocions')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-promocions');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('promocion');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('promocions', [AdminController::class, 'index'])->name('index-promocions')->middleware('can:read promocions');
            $router->get('promocions/export', [AdminController::class, 'export'])->name('export-promocions')->middleware('can:read promocions');
            $router->get('promocions/create', [AdminController::class, 'create'])->name('create-promocion')->middleware('can:create promocions');
            $router->get('promocions/{promocion}/edit', [AdminController::class, 'edit'])->name('edit-promocion')->middleware('can:read promocions');
            $router->post('promocions', [AdminController::class, 'store'])->name('store-promocion')->middleware('can:create promocions');
            $router->post('promociones/guardar-libros', [AdminController::class, 'guardar_libros'])->name('store-libros')->middleware('can:create promocions');
            $router->put('promocions/{promocion}', [AdminController::class, 'update'])->name('update-promocion')->middleware('can:update promocions');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('promocions', [ApiController::class, 'index'])->middleware('can:read promocions');
            $router->patch('promocions/{promocion}', [ApiController::class, 'updatePartial'])->middleware('can:update promocions');
            $router->delete('promocions/{promocion}', [ApiController::class, 'destroy'])->middleware('can:delete promocions');

            $router->post('updateImportedPromo', [ApiController::class, 'updateImported'])->middleware('can:update promocions');
            
        });

        Route::post('/api/check-promocion/', [ApiController::class, 'checkPromocion']);
        //Route::post('/admin/check-promocion/', [ApiController::class, 'checkPromocion']);
        

        
    }
}
