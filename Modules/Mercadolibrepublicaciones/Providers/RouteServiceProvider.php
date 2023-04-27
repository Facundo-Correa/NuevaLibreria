<?php

namespace TypiCMS\Modules\Mercadolibrepublicaciones\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Mercadolibrepublicaciones\Http\Controllers\AdminController;
use TypiCMS\Modules\Mercadolibrepublicaciones\Http\Controllers\ApiController;
use TypiCMS\Modules\Mercadolibrepublicaciones\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('mercadolibrepublicaciones')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-mercadolibrepublicaciones');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('mercadolibrepublicacione');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('mercadolibrepublicaciones/articulo={articulo}/pagina={pagina}', [AdminController::class, 'index'])->name('index-mercadolibrepublicaciones')->middleware('can:read mercadolibrepublicaciones');
            $router->get('mercadolibrepublicaciones/articulo={articulo}/pagina=0', [AdminController::class, 'index'])->name('index-mercadolibrepublicaciones')->middleware('can:read mercadolibrepublicaciones');
            $router->get('mercadolibrepublicaciones/articulo=a/pagina=0', [AdminController::class, 'index'])->name('index-mercadolibrepublicaciones')->middleware('can:read mercadolibrepublicaciones');
            $router->get('mercadolibrepublicaciones/export', [AdminController::class, 'export'])->name('export-mercadolibrepublicaciones')->middleware('can:read mercadolibrepublicaciones');
            $router->get('mercadolibrepublicaciones/create', [AdminController::class, 'create'])->name('create-mercadolibrepublicacione')->middleware('can:create mercadolibrepublicaciones');
            $router->get('mercadolibrepublicaciones/{mercadolibrepublicacione}/edit', [AdminController::class, 'edit'])->name('edit-mercadolibrepublicacione')->middleware('can:read mercadolibrepublicaciones');
            $router->post('mercadolibrepublicaciones', [AdminController::class, 'store'])->name('store-mercadolibrepublicacione')->middleware('can:create mercadolibrepublicaciones');
            $router->put('mercadolibrepublicaciones/{mercadolibrepublicacione}', [AdminController::class, 'update'])->name('update-mercadolibrepublicacione')->middleware('can:update mercadolibrepublicaciones');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('mercadolibrepublicaciones', [ApiController::class, 'index'])->middleware('can:read mercadolibrepublicaciones');
            $router->patch('mercadolibrepublicaciones/{mercadolibrepublicacione}', [ApiController::class, 'updatePartial'])->middleware('can:update mercadolibrepublicaciones');
            $router->delete('mercadolibrepublicaciones/{mercadolibrepublicacione}', [ApiController::class, 'destroy'])->middleware('can:delete mercadolibrepublicaciones');
        });
    }
}
