<?php

namespace TypiCMS\Modules\Booklists\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Booklists\Presenters\ModulePresenter;
use TypiCMS\Modules\Booklists\Models\Booklist;
use TypiCMS\Modules\Books\Models\Book;

class Booklistsbooks extends Base
{
    protected $guarded = [];

    protected $table = 'booklists_books';

    protected $fillable = [
        'booklists_id',
        'books_id'
    ];

    public function lists(): BelongsTo
    {
        return $this->belongsTo(Booklist::class);
    }

    public function books(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
