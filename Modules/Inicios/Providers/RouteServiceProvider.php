<?php

namespace TypiCMS\Modules\Inicios\Providers;

use App\Http\Controllers\InicioController;
use App\SobreNosotros;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Inicios\Http\Controllers\AdminController;
use TypiCMS\Modules\Inicios\Http\Controllers\ApiController;
use TypiCMS\Modules\Inicios\Http\Controllers\ExposicionesController;
use TypiCMS\Modules\Inicios\Http\Controllers\NEditorialController;
use TypiCMS\Modules\Inicios\Http\Controllers\NosotrosController;
use TypiCMS\Modules\Inicios\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('inicios')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang . '::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-inicios');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('inicio');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('inicio', [InicioController::class, 'index'])->name('index-inicios')->middleware('can:read inicios');
            $router->post('inicio/crear', [InicioController::class, 'crear'])->name('crear-inicio')->middleware('can:read inicios');
            $router->post('inicio/editar', [InicioController::class, 'editar'])->name('editar-inicio')->middleware('can:read inicios');
            $router->post('inicio/guardar', [InicioController::class, 'guardar'])->name('guardar-inicio')->middleware('can:read inicios');
            $router->post('inicio/eliminar', [InicioController::class, 'eliminar'])->name('eliminar-inicio')->middleware('can:read inicios');
            $router->post('inicio/obtener', [InicioController::class, 'obtener'])->name('obtener-inicio')->middleware('can:read inicios');
            $router->post('inicio/cambiar-estado', [InicioController::class, 'cEstado'])->name('cambiar-estado-inicio')->middleware('can:read inicios');
            $router->post('inicio/obtener-estado', [InicioController::class, 'oEstado'])->name('cambiar-estado-inicio')->middleware('can:read inicios');
            $router->post('inicio/guardar-props', [InicioController::class, 'guardarProps'])->name('cambiar-estado-inicio')->middleware('can:read inicios');

            $router->get('exposiciones', [ExposicionesController::class, 'index'])->name('index-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/crear', [ExposicionesController::class, 'crear'])->name('crear-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/editar', [ExposicionesController::class, 'editar'])->name('editar-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/eliminar', [ExposicionesController::class, 'eliminar'])->name('guardar-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/guardar', [ExposicionesController::class, 'guardar'])->name('guardar-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/obtener', [ExposicionesController::class, 'obtener'])->name('obtener-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/cambiar-estado', [ExposicionesController::class, 'changeEstado'])->name('change-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/obtener-estado', [ExposicionesController::class, 'getEstado'])->name('getEstado-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/guardar-imagenes', [ExposicionesController::class, 'guardarImagenes'])->name('getEstado-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/obtener-imagenes', [ExposicionesController::class, 'getImagenes'])->name('getImagenes-inicio-exposiciones')->middleware('can:read inicios');
            $router->post('exposiciones/GetById', [ExposicionesController::class, 'getById'])->name('getImagenes-inicio-exposiciones')->middleware('can:read inicios');

            $router->get('sobre-nosotros', [NosotrosController::class, 'index'])->name('index-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/obtener', [NosotrosController::class, 'obtener'])->name('obtener-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/crear', [NosotrosController::class, 'crear'])->name('create-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/editar', [NosotrosController::class, 'editar'])->name('editar-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/eliminar', [NosotrosController::class, 'eliminar'])->name('eliminar-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/guardar', [NosotrosController::class, 'guardar'])->name('gEstado-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/cambiar-estado', [NosotrosController::class, 'cEstado'])->name('cEstado-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/obtener-estado', [NosotrosController::class, 'oEstado'])->name('oEstado-inicio-nosotros')->middleware('can:read inicios');
            $router->post('sobre-nosotros/GetById', [NosotrosController::class, 'GetByID'])->name('GetByID-inicio-nosotros')->middleware('can:read inicios');

            $router->get('nuestra-editorial', [NEditorialController::class, 'index'])->name('index-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/obtener', [NEditorialController::class, 'obtener'])->name('obtener-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/crear', [NEditorialController::class, 'crear'])->name('create-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/editar', [NEditorialController::class, 'editar'])->name('editar-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/eliminar', [NEditorialController::class, 'eliminar'])->name('eliminar-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/guardar', [NEditorialController::class, 'guardar'])->name('guardar-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/guardar-libros', [NEditorialController::class, 'guardarLibros'])->name('guardar-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/obtener-libros', [NEditorialController::class, 'obtenerLibros'])->name('guardar-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/cambiar-estado', [NEditorialController::class, 'cEstado'])->name('cEstado-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/obtener-estado', [NEditorialController::class, 'oEstado'])->name('oEstado-inicio-nuestra-editorial')->middleware('can:read inicios');
            $router->post('nuestra-editorial/GetById', [NEditorialController::class, 'GetById'])->name('GetById-inicio-nuestra-editorial')->middleware('can:read inicios');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('inicios', [ApiController::class, 'index'])->middleware('can:read inicios');
            $router->patch('inicios/{inicio}', [ApiController::class, 'updatePartial'])->middleware('can:update inicios');
            $router->delete('inicios/{inicio}', [ApiController::class, 'destroy'])->middleware('can:delete inicios');
        });
    }
}
