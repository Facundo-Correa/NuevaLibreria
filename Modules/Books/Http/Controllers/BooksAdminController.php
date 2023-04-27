<?php

namespace TypiCMS\Modules\Books\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Books\Exports\Export;
use TypiCMS\Modules\Books\Http\Requests\FormRequest;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Books\Models\Bookdescription;
use TypiCMS\Modules\Tags\Models\Tag;
use Illuminate\Support\Arr;

class BooksAdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('books::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d') . ' ' . config('app.name') . ' books.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Book();

        return view('books::admin.create')
            ->with(compact('model'));
    }

    public function edit(book $book): View
    {

        $loadBook = $book->load(['descriptions', 'tags']);

        $modeltags = [];
        foreach ($loadBook->tags->toArray() as $booktag) {
            array_push($modeltags, $booktag['id']);
        };

        $tags = Tag::all();

        return view('books::admin.edit')
            ->with([
                'model' => $loadBook,
                'tags' => $tags,
                'modeltags' => $modeltags
            ]);
    }

    public function store(FormRequest $request): RedirectResponse
    {   
        $book = Book::create($request->validated());

        return $this->redirect($request, $book);
    }

    public function update(book $book, FormRequest $request): RedirectResponse
    {

        $data = $request->validated();

        if ($data['descriptions_indice'] !== null || $data['descriptions_description'] !== null) {
            if (!$book->descriptions) {
                Bookdescription::create([
                    'indice' => $data['descriptions_indice'],
                    'description' => $data['descriptions_description'],
                    'book_id' => $data['id']
                ]);
            } else {

                if ($data['descriptions_indice'] !== null && $data['descriptions_indice'] !== $book->descriptions->indice) {
                    $book->descriptions->indice = $data['descriptions_indice'];
                }

                if ($data['descriptions_description'] !== null && $data['descriptions_description'] !== $book->descriptions->description) {
                    $book->descriptions->description = $data['descriptions_description'];
                }

                $book->descriptions->save();
            }
        }

        if (Arr::exists($data, 'tags') && count($data['tags']) > 0) {
            $book->tags()->sync($data['tags']);
        }

        return $this->redirect($request, $book);
    }
}
