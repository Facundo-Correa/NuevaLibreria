<?php

namespace TypiCMS\Modules\Features\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Features\Http\Controllers\AdminController;
use TypiCMS\Modules\Features\Http\Controllers\ApiController;
use TypiCMS\Modules\Features\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('features')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-features');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('feature');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('features', [AdminController::class, 'index'])->name('index-features')->middleware('can:read features');
            $router->get('features/export', [AdminController::class, 'export'])->name('export-features')->middleware('can:read features');
            $router->get('features/create', [AdminController::class, 'create'])->name('create-feature')->middleware('can:create features');
            $router->get('features/{feature}/edit', [AdminController::class, 'edit'])->name('edit-feature')->middleware('can:read features');
            $router->post('features', [AdminController::class, 'store'])->name('store-feature')->middleware('can:create features');
            $router->put('features/{feature}', [AdminController::class, 'update'])->name('update-feature')->middleware('can:update features');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('features', [ApiController::class, 'index'])->middleware('can:read features');
            $router->patch('features/{feature}', [ApiController::class, 'updatePartial'])->middleware('can:update features');
            $router->delete('features/{feature}', [ApiController::class, 'destroy'])->middleware('can:delete features');
        });
    }
}
