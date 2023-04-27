<?php

namespace TypiCMS\Modules\Books\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Bookcategories\Presenters\CategoriesModulePresenter;

class Bookcategory extends Base
{
    // use HasFiles;
    // use HasTranslations;
    // use Historable;
    // use PresentableTrait;

    // protected $presenter = CategoriesModulePresenter::class;

    protected $guarded = [];

    protected $table = 'book_categories';

    protected $fillable = [
        'name',
        'codigocat',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
