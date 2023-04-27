<?php

namespace TypiCMS\Modules\Preguntas\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Preguntas\Http\Controllers\AdminController;
use TypiCMS\Modules\Preguntas\Http\Controllers\ApiController;
use TypiCMS\Modules\Preguntas\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('preguntas')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-preguntas');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('pregunta');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('preguntas', [AdminController::class, 'index'])->name('index-preguntas')->middleware('can:read preguntas');
            $router->get('preguntas/export', [AdminController::class, 'export'])->name('export-preguntas')->middleware('can:read preguntas');
            $router->get('preguntas/create', [AdminController::class, 'create'])->name('create-pregunta')->middleware('can:create preguntas');
            $router->get('preguntas/{pregunta}/edit', [AdminController::class, 'edit'])->name('edit-pregunta')->middleware('can:read preguntas');
            $router->post('preguntas', [AdminController::class, 'store'])->name('store-pregunta')->middleware('can:create preguntas');
            $router->put('preguntas/{pregunta}', [AdminController::class, 'update'])->name('update-pregunta')->middleware('can:update preguntas');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('preguntas', [ApiController::class, 'index'])->middleware('can:read preguntas');
            $router->patch('preguntas/{pregunta}', [ApiController::class, 'updatePartial'])->middleware('can:update preguntas');
            $router->delete('preguntas/{pregunta}', [ApiController::class, 'destroy'])->middleware('can:delete preguntas');
        });
    }
}
