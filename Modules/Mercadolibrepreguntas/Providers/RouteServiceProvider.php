<?php

namespace TypiCMS\Modules\Mercadolibrepreguntas\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Mercadolibrepreguntas\Http\Controllers\AdminController;
use TypiCMS\Modules\Mercadolibrepreguntas\Http\Controllers\ApiController;
use TypiCMS\Modules\Mercadolibrepreguntas\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('mercadolibrepreguntas')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-mercadolibrepreguntas');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('mercadolibrepregunta');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('mercadolibrepreguntas', [AdminController::class, 'index'])->name('index-mercadolibrepreguntas')->middleware('can:read mercadolibrepreguntas');
            $router->get('mercadolibrepreguntas/export', [AdminController::class, 'export'])->name('export-mercadolibrepreguntas')->middleware('can:read mercadolibrepreguntas');
            $router->get('mercadolibrepreguntas/create', [AdminController::class, 'create'])->name('create-mercadolibrepregunta')->middleware('can:create mercadolibrepreguntas');
            $router->get('mercadolibrepreguntas/{mercadolibrepregunta}/edit', [AdminController::class, 'edit'])->name('edit-mercadolibrepregunta')->middleware('can:read mercadolibrepreguntas');
            $router->post('mercadolibrepreguntas', [AdminController::class, 'store'])->name('store-mercadolibrepregunta')->middleware('can:create mercadolibrepreguntas');
            $router->put('mercadolibrepreguntas/{mercadolibrepregunta}', [AdminController::class, 'update'])->name('update-mercadolibrepregunta')->middleware('can:update mercadolibrepreguntas');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('mercadolibrepreguntas', [ApiController::class, 'index'])->middleware('can:read mercadolibrepreguntas');
            $router->patch('mercadolibrepreguntas/{mercadolibrepregunta}', [ApiController::class, 'updatePartial'])->middleware('can:update mercadolibrepreguntas');
            $router->delete('mercadolibrepreguntas/{mercadolibrepregunta}', [ApiController::class, 'destroy'])->middleware('can:delete mercadolibrepreguntas');
        
            $router->post('mercado-libre/contestar', [ApiController::class, 'responder']);
        });
    }
}
