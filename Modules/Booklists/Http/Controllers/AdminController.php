<?php

namespace TypiCMS\Modules\Booklists\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Booklists\Exports\Export;
use TypiCMS\Modules\Booklists\Http\Requests\FormPromoRequest;
use TypiCMS\Modules\Booklists\Http\Requests\FormPublicidadRequest;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Booklists\Models\Booklist;
use TypiCMS\Modules\Booklists\Models\Booklisttype;
use TypiCMS\Modules\Booklists\Models\Booklistsbooks;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Arr;
use TypiCMS\Modules\Booklists\Http\Requests\FormCarouselRequest;
use TypiCMS\Modules\Booklists\Http\Requests\FormRequest;
use TypiCMS\Modules\Booklists\Models\Booklistssections;

class AdminController extends BaseAdminController
{

    // || Mauro no documentó mucho, pero con solo ver su codigo es suficiente para entender las cuestiones.
    // || Lo unico que cambiaria yo, es la creacion de un controlador para cada sector; el medio que metio todo aca xD.

    public function indexPromos(): View
    {
        return view('booklists::admin.promos.index');
    }

    public function indexPublicidades(): View
    {
        return view('booklists::admin.publicidades.index');
    }

    public function indexCarousels(): View
    {
        return view('booklists::admin.carousels.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d') . ' ' . config('app.name') . ' booklists.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function createPromo(): View
    {
        $model = new Booklist();


        $sectionsPromo = Booklistssections::where('parent_id', 1)->get();

        $sections = ['' => ''];
        foreach ($sectionsPromo as $properties) {
            $sections[$properties['id']] = ($properties['label']);
        }
        asort($sections);

        return view('booklists::admin.promos.create')
            ->with([
                'model' => $model,
                'sections' => $sections
            ]);
    }

    public function createPublicidad(): View
    {
        $model = new Booklist();

        $sectionsPromo = Booklistssections::where('parent_id', 2)->get();

        $sections = ['' => ''];
        foreach ($sectionsPromo as $properties) {
            $sections[$properties['id']] = ($properties['label']);
        }
        asort($sections);

        return view('booklists::admin.publicidades.create')
            ->with([
                'model' => $model,
                'sections' => $sections
            ]);
    }

    public function createCarousel(): View
    {
        $model = new Booklist();

        $sectionsPromo = Booklistssections::where('parent_id', 3)->get();

        $sections = ['' => ''];
        foreach ($sectionsPromo as $properties) {
            $sections[$properties['id']] = ($properties['label']);
        }
        asort($sections);

        return view('booklists::admin.carousels.create')
            ->with([
                'model' => $model,
                'sections' => $sections
            ]);
    }

    public function editPromo(booklist $booklist): View
    {
        $sectionsPromo = Booklistssections::where('parent_id', 1)->get();

        $sections = ['' => ''];
        foreach ($sectionsPromo as $properties) {
            $sections[$properties['id']] = ($properties['label']);
        }
        asort($sections);

        $listwithbarcodes = $booklist->load(['books.books']);


        $barcodes = [];

        foreach ($listwithbarcodes->books as $barcode) {
            array_push($barcodes, $barcode->books->barcode);
        }
        $booklist->barcodes = $barcodes;

        return view('booklists::admin.promos.edit')
            ->with(['model' => $booklist, 'sections' => $sections]);
    }

    public function editPublicidad(booklist $booklist): View
    {
        $sectionsPromo = Booklistssections::where('parent_id', 2)->get();

        $sections = ['' => ''];
        foreach ($sectionsPromo as $properties) {
            $sections[$properties['id']] = ($properties['label']);
        }
        asort($sections);

        return view('booklists::admin.publicidades.edit')
            ->with(['model' => $booklist, 'sections' => $sections]);
    }

    public function editCarousel(booklist $booklist): View
    {
        $sectionsPromo = Booklistssections::where('parent_id', 3)->get();

        $sections = ['' => ''];
        foreach ($sectionsPromo as $properties) {
            $sections[$properties['id']] = ($properties['label']);
        }
        asort($sections);

        return view('booklists::admin.carousels.edit')
            ->with(['model' => $booklist, 'sections' => $sections]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::beginTransaction();

        $booklist = Booklist::create([
            'title' => $data['title'],
            'booklists_types_id' => $data['booklists_types_id'],
            'status' => $data['status'],
            'position' => $data['position'],
            'booklists_sections_id' => $data['booklists_sections_id']
        ]);

        if (Arr::exists($data, 'barcode') && count($data['barcode']) > 0) {
            $barcodes = $data['barcode'];

            $books_ids = [];

            foreach ($barcodes as $barcode) {
                if ($barcode !== null) {
                    $booka = Book::where('barcode', $barcode)->first();

                    if ($booka === null) {
                        DB::rollback();
                        return back()->withErrors('El codigo ' . $barcode . ' no coincide con ningun libro');
                    }

                    array_push($books_ids, $booka->id);
                }
            }

            foreach ($books_ids as $bookid) {
                Booklistsbooks::create([
                    'booklists_id' => $booklist->id,
                    'books_id' => $bookid,
                ]);
            }
        }

        DB::commit();

        return $this->redirect($request, $booklist);
    }

    public function update(booklist $booklist, FormPromoRequest $request): RedirectResponse
    {

        $data = $request->validated();

        DB::beginTransaction();

        if ($booklist->title !== $request->title) {
            $booklist->title = $request->title;
        }
        if ($booklist->booklists_types_id !== $request->booklists_types_id) {
            $booklist->booklists_types_id = $request->booklists_types_id;
        }
        if ($booklist->status !== $request->status) {
            $booklist->status = $request->status;
        }
        if ($booklist->position !== $request->position) {
            $booklist->position = $request->position;
        }
        if ($booklist->booklists_sections_id !== $request->booklists_sections_id) {
            $booklist->booklists_sections_id = $request->booklists_sections_id;
        }

        if (Arr::exists($data, 'barcode') && count($data['barcode']) > 0) {

            $oldbarcodesload = $booklist->load(['books.books']);
            $oldbarcodes = [];

            foreach ($oldbarcodesload->books as $barcode) {
                array_push($oldbarcodes, $barcode->books->barcode);
            }

            $barcodes = $data['barcode'];

            foreach ($oldbarcodes as $oldbar) {
                $oldbook_id = Book::where('barcode', $oldbar)->first();

                if (!in_array($oldbar, $barcodes)) {
                    Booklistsbooks::where('books_id', $oldbook_id->id)->where('booklists_id', $booklist->id)->delete();
                } else {
                    $keycode = array_search($oldbar, $barcodes);
                    unset($barcodes[$keycode]);
                }
            }


            $books_ids = [];

            foreach ($barcodes as $barcode) {
                if ($barcode !== null) {
                    $booka = Book::where('barcode', $barcode)->first();

                    if ($booka === null) {
                        DB::rollback();
                        return back()->withErrors('El codigo ' . $barcode . ' no coincide con ningun libro');
                    }

                    array_push($books_ids, $booka->id);
                }
            }

            foreach ($books_ids as $bookid) {
                Booklistsbooks::create([
                    'booklists_id' => $booklist->id,
                    'books_id' => $bookid,
                ]);
            }
        }

        $booklist->save();

        DB::commit();

        return $this->redirect($request, $booklist);
    }

    public function obtenerPromos()
    {
    }
}
