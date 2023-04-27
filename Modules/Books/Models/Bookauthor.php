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
use TypiCMS\Modules\Bookauthors\Presenters\ModulePresenter;

class Bookauthor extends Base
{
    // use HasFiles;
    // use HasTranslations;
    // use Historable;
    // use PresentableTrait;

    // protected $presenter = ModulePresenter::class;

    protected $table = 'book_authors';

    protected $guarded = [];

    public $fillable = [
        'first_name',
        'last_name',
    ];

    protected $appends = [
        'fullname'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
