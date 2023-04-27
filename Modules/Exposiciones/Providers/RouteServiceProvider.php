<?php

namespace TypiCMS\Modules\Exposiciones\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Exposiciones\Http\Controllers\AdminController;
use TypiCMS\Modules\Exposiciones\Http\Controllers\ApiController;
use TypiCMS\Modules\Exposiciones\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('exposiciones')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-exposiciones');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('exposicione');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('exposiciones', [AdminController::class, 'index'])->name('index-exposiciones')->middleware('can:read exposiciones');
            $router->get('exposiciones/export', [AdminController::class, 'export'])->name('export-exposiciones')->middleware('can:read exposiciones');
            $router->get('exposiciones/create', [AdminController::class, 'create'])->name('create-exposicione')->middleware('can:create exposiciones');
            $router->get('exposiciones/{exposicione}/edit', [AdminController::class, 'edit'])->name('edit-exposicione')->middleware('can:read exposiciones');
            $router->post('exposiciones', [AdminController::class, 'store'])->name('store-exposicione')->middleware('can:create exposiciones');
            $router->put('exposiciones/{exposicione}', [AdminController::class, 'update'])->name('update-exposicione')->middleware('can:update exposiciones');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('exposiciones', [ApiController::class, 'index'])->middleware('can:read exposiciones');
            $router->patch('exposiciones/{exposicione}', [ApiController::class, 'updatePartial'])->middleware('can:update exposiciones');
            $router->delete('exposiciones/{exposicione}', [ApiController::class, 'destroy'])->middleware('can:delete exposiciones');
        });
    }
}
