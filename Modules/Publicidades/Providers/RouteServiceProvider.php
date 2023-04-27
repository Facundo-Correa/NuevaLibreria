<?php

namespace TypiCMS\Modules\Publicidades\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Publicidades\Http\Controllers\AdminController;
use TypiCMS\Modules\Publicidades\Http\Controllers\ApiController;
use TypiCMS\Modules\Publicidades\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('publicidades')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-publicidades');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('publicidade');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('publicidades', [AdminController::class, 'index'])->name('index-publicidades')->middleware('can:read publicidades');
            $router->get('publicidades/export', [AdminController::class, 'export'])->name('export-publicidades')->middleware('can:read publicidades');
            $router->get('publicidades/create', [AdminController::class, 'create'])->name('create-publicidade')->middleware('can:create publicidades');
            $router->get('publicidades/{publicidade}/edit', [AdminController::class, 'edit'])->name('edit-publicidade')->middleware('can:read publicidades');
            $router->post('publicidades', [AdminController::class, 'store'])->name('store-publicidade')->middleware('can:create publicidades');
            $router->put('publicidades/{publicidade}', [AdminController::class, 'update'])->name('update-publicidade')->middleware('can:update publicidades');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('publicidades', [ApiController::class, 'index'])->middleware('can:read publicidades');
            $router->patch('publicidades/{publicidade}', [ApiController::class, 'updatePartial'])->middleware('can:update publicidades');
            $router->delete('publicidades/{publicidade}', [ApiController::class, 'destroy'])->middleware('can:delete publicidades');
        });
    }
}
