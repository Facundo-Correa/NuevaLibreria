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

class Booklistssections extends Base
{
    protected $guarded = [];

    protected $table = 'booklists_sections';

    protected $fillable = [
        'parent_id',
        'name',
        'label'
    ];

    public function lists(): HasMany
    {
        return $this->HasMany(Booklist::class);
    }
}
