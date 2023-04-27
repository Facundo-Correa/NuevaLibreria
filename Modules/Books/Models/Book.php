<?php

namespace TypiCMS\Modules\Books\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\Tags\Models\Tag;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Books\Presenters\ModulePresenter;
use TypiCMS\Modules\Books\Models\Bookauthor;
use TypiCMS\Modules\Books\Models\Bookcategory;
use TypiCMS\Modules\Books\Models\Booktype;
use TypiCMS\Modules\Books\Models\Publisher;


class Book extends Base
{
    use HasFiles;
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    protected $fillable = [
        'isbn',
        'isbn1',
        'root_publisher',
        'publisher',
        'barcode',
        'title',
        'author_1',
        'author_2',
        'author_3',
        'theme_1',
        'theme_2',
        'theme_3',
        'book_category',
        'edition',
        'weight',
        'backcover',
        'price',
        'ml_status',
        'available',
        'commentary',
        'indice',
        'upload',
        'upload_date',
        'modify_date'
    ];

    /*
    public function category(): BelongsTo
    {
        return $this->belongsTo(Bookcategory::class, 'book_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Bookauthor::class, 'author_id');
    }

    public function author2(): BelongsTo
    {
        return $this->belongsTo(Bookauthor::class, 'author2_id');
    }

    public function author3(): BelongsTo
    {
        return $this->belongsTo(Bookauthor::class, 'author3_id');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Bookauthor::class, 'book_type_id');
    }
*/
    public function descriptions(): HasOne
    {
        return $this->hasOne(Bookdescription::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function lists(): HasMany
    {
        return $this->hasMany(Booklistsbooks::class);
    }

    public function getTranslation()
    {
        return;
    }

    public function getTranslations()
    {
        return;
    }
}
