<?php

namespace TypiCMS\Modules\Booklists\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Booklists\Http\Controllers\AdminController;
use TypiCMS\Modules\Booklists\Http\Controllers\ApiController;
use TypiCMS\Modules\Booklists\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('booklists')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang . '::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-booklists');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('booklist');
                    });
                }
            }
        }

        /*
         * Admin routes
         */

        // || Todo esto tengo que cambiarlo, no podemos seguir trabajando con GET, un dia podemos tener un problema.

        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('booklists/export', [AdminController::class, 'export'])->name('export-booklists')->middleware('can:read booklists');
            $router->post('booklists', [AdminController::class, 'store'])->name('store-booklist')->middleware('can:create booklists');
            $router->put('booklists/{booklist}', [AdminController::class, 'update'])->name('update-booklist')->middleware('can:update booklists');

            //promos

            $router->get('booklists/promos', [AdminController::class, 'indexPromos'])->name('index-booklists-promos')->middleware('can:read booklists');
            $router->post('booklists/promos/obtener', [AdminController::class, 'obtener'])->name('obtener-booklists-promos')->middleware('can:read booklists');
            $router->get('booklists/promos/create', [AdminController::class, 'createPromo'])->name('create-booklists-promos')->middleware('can:create booklists');
            $router->get('booklists/promos/{booklist}/edit', [AdminController::class, 'editPromo'])->name('edit-booklist-promos')->middleware('can:read booklists');
            $router->get('booklists/promos/{booklist}/edit', [AdminController::class, 'editPromo'])->name('edit-booklist-promos')->middleware('can:read booklists');

            //publicidades

            $router->get('booklists/publicidades', [AdminController::class, 'indexPublicidades'])->name('index-booklists-publicidades')->middleware('can:read booklists');
            $router->get('booklists/publicidades/create', [AdminController::class, 'createPublicidad'])->name('create-booklists-publicidades')->middleware('can:create booklists');
            $router->get('booklists/publicidades/{booklist}/edit', [AdminController::class, 'editPublicidad'])->name('edit-booklist-publicidades')->middleware('can:read booklists');

            //carousels

            $router->get('booklists/carousels', [AdminController::class, 'indexCarousels'])->name('index-booklists-carousels')->middleware('can:read booklists');
            $router->get('booklists/carousels/create', [AdminController::class, 'createCarousel'])->name('create-booklists-carousels')->middleware('can:create booklists');
            $router->get('booklists/carousels/{booklist}/edit', [AdminController::class, 'editCarousel'])->name('edit-booklist-carousels')->middleware('can:read booklists');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('booklists', [ApiController::class, 'index'])->middleware('can:read booklists');
            $router->get('booklists/promos', [ApiController::class, 'indexPromos'])->middleware('can:read booklists');
            $router->get('booklists/publicidades', [ApiController::class, 'indexPublicidades'])->middleware('can:read booklists');
            $router->get('booklists/carousels', [ApiController::class, 'indexCarousels'])->middleware('can:read booklists');
            $router->patch('booklists/{booklist}', [ApiController::class, 'updatePartial'])->middleware('can:update booklists');
            $router->patch('booklists/promos/{booklist}', [ApiController::class, 'updatePartial'])->middleware('can:update booklists');
            $router->patch('booklists/publicidades/{booklist}', [ApiController::class, 'updatePartial'])->middleware('can:update booklists');
            $router->patch('booklists/carousels/{booklist}', [ApiController::class, 'updatePartial'])->middleware('can:update booklists');
            $router->delete('booklists/{booklist}', [ApiController::class, 'destroy'])->middleware('can:delete booklists');
            $router->delete('booklists/promos/{booklist}', [ApiController::class, 'destroy'])->middleware('can:delete booklists');
            $router->delete('booklists/publicidades/{booklist}', [ApiController::class, 'destroy'])->middleware('can:delete booklists');
            $router->delete('booklists/carousels/{booklist}', [ApiController::class, 'destroy'])->middleware('can:delete booklists');

            $router->get('booklists/{booklists}/files', [ApiController::class, 'files'])->middleware('can:update booklists');
            $router->post('booklists/{booklists}/files', [ApiController::class, 'attachFiles'])->middleware('can:update booklists');
            $router->delete('booklists/{booklists}/files/{file}', [ApiController::class, 'detachFile'])->middleware('can:update booklists');
        });
    }
}
