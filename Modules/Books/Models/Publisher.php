<?php

namespace TypiCMS\Modules\Books\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Publishers\Presenters\ModulePresenter;

class Publisher extends Base
{
    // use HasFiles;
    // use HasTranslations;
    // use Historable;
    // use PresentableTrait;

    // protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    protected $table = "publishers";

    protected $fillable = [
        'name',
        'isbn'
    ];
}
