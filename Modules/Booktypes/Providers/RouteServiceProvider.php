<?php

namespace TypiCMS\Modules\Booktypes\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Booktypes\Http\Controllers\AdminController;
use TypiCMS\Modules\Booktypes\Http\Controllers\ApiController;
use TypiCMS\Modules\Booktypes\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('booktypes')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-booktypes');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('booktype');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('booktypes', [AdminController::class, 'index'])->name('index-booktypes')->middleware('can:read booktypes');
            $router->get('booktypes/export', [AdminController::class, 'export'])->name('export-booktypes')->middleware('can:read booktypes');
            $router->get('booktypes/create', [AdminController::class, 'create'])->name('create-booktype')->middleware('can:create booktypes');
            $router->get('booktypes/{booktype}/edit', [AdminController::class, 'edit'])->name('edit-booktype')->middleware('can:read booktypes');
            $router->post('booktypes', [AdminController::class, 'store'])->name('store-booktype')->middleware('can:create booktypes');
            $router->put('booktypes/{booktype}', [AdminController::class, 'update'])->name('update-booktype')->middleware('can:update booktypes');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('booktypes', [ApiController::class, 'index'])->middleware('can:read booktypes');
            $router->patch('booktypes/{booktype}', [ApiController::class, 'updatePartial'])->middleware('can:update booktypes');
            $router->delete('booktypes/{booktype}', [ApiController::class, 'destroy'])->middleware('can:delete booktypes');
        });
    }
}
