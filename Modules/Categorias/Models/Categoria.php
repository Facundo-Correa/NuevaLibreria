<?php

namespace TypiCMS\Modules\Categorias\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Categorias\Presenters\ModulePresenter;

class Categoria extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected $table = "book_categories";

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    protected $fillable = [
        'codigocat',
        'name'
    ];

    public $translatable = [
        'title',
        'slug',
        'status',
        'summary',
        'body'
    ];

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }
}
