<?php

namespace TypiCMS\Modules\Books\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Books\Http\Controllers\BooksAdminController;
use TypiCMS\Modules\Books\Http\Controllers\BooksApiController;
use TypiCMS\Modules\Books\Http\Controllers\BooksPublicController;
use TypiCMS\Modules\Books\Http\Controllers\BookAuthorsAdminController;
use TypiCMS\Modules\Books\Http\Controllers\BookAuthorsApiController;
use TypiCMS\Modules\Books\Http\Controllers\BookAuthorsPublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        //Books
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('books')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang . '::')->group(function (Router $router) {
                        $router->get('/', [BooksPublicController::class, 'index'])->name('index-books');
                        $router->get('{slug}', [BooksPublicController::class, 'show'])->name('book');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('books', [BooksAdminController::class, 'index'])->name('index-books')->middleware('can:read books');
            $router->get('books/export', [BooksAdminController::class, 'export'])->name('export-books')->middleware('can:read books');
            $router->get('books/create', [BooksAdminController::class, 'create'])->name('create-book')->middleware('can:create books');
            $router->get('books/{book}/edit', [BooksAdminController::class, 'edit'])->name('edit-book')->middleware('can:read books');
            $router->post('books', [BooksAdminController::class, 'store'])->name('store-book')->middleware('can:create books');
            $router->put('books/{book}', [BooksAdminController::class, 'update'])->name('update-book')->middleware('can:update books');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('books', [BooksApiController::class, 'index'])->middleware('can:read books');
            $router->patch('books/{book}', [BooksApiController::class, 'updatePartial'])->middleware('can:update books');
            $router->delete('books/{book}', [BooksApiController::class, 'destroy'])->middleware('can:delete books');
            
        });

        /*
        * FRONT routes
        */
        Route::get('/libro/{isbn}', [BooksApiController::class, 'redirectToBook']);
        // || Esta funcion es para obtener libros por lote mediante sus ISBN
        Route::post('/api/books/isbns', [BooksApiController::class, 'getISBNS']);
    }
}
