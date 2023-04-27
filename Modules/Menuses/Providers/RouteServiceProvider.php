<?php

namespace TypiCMS\Modules\Menuses\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Menuses\Http\Controllers\AdminController;
use TypiCMS\Modules\Menuses\Http\Controllers\ApiController;
use TypiCMS\Modules\Menuses\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('menuses')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-menuses');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('menus');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('menuses', [AdminController::class, 'index'])->name('index-menuses')->middleware('can:read menuses');
            $router->get('menuses/export', [AdminController::class, 'export'])->name('export-menuses')->middleware('can:read menuses');
            $router->get('menuses/create', [AdminController::class, 'create'])->name('create-menus')->middleware('can:create menuses');
            $router->get('menuses/{menus}/edit', [AdminController::class, 'edit'])->name('edit-menus')->middleware('can:read menuses');
            $router->post('menuses', [AdminController::class, 'store'])->name('store-menus')->middleware('can:create menuses');
            $router->put('menuses/{menus}', [AdminController::class, 'update'])->name('update-menus')->middleware('can:update menuses');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('menuses', [ApiController::class, 'index'])->middleware('can:read menuses');
            $router->patch('menuses/{menus}', [ApiController::class, 'updatePartial'])->middleware('can:update menuses');
            $router->delete('menuses/{menus}', [ApiController::class, 'destroy'])->middleware('can:delete menuses');
        });
    }
}
