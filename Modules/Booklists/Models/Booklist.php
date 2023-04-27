<?php

namespace TypiCMS\Modules\Booklists\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Booklists\Presenters\ModulePresenter;

class Booklist extends Base
{
    use HasFiles;
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'status',
        'position',
        'image_id',
        'booklists_types_id',
        'booklists_sections_id',
    ];

    public function bookListType(): BelongsTo
    {
        return $this->belongsTo(Booklisttype::class);
    }

    public function listsection(): BelongsTo
    {
        return $this->belongsTo(Booklistssections::class, 'booklists_sections_id');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Booklistsbooks::class, 'booklists_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function getTranslation()
    {
        return;
    }

    public function getTranslations()
    {
        return;
    }

    public function indexUrl(): string
    {
        if ($this->booklists_types_id == 1) {
            $route = 'admin::index-booklists-promos';
        }
        if ($this->booklists_types_id == 2) {
            $route = 'admin::index-booklists-publicidades';
        }
        if ($this->booklists_types_id == 3) {
            $route = 'admin::index-booklists-carousels';
        }
        if (Route::has($route)) {
            return route($route, $this->id);
        }

        return route('admin::dashboard');
    }

    public function editUrl(): string
    {
        if ($this->booklists_types_id == 1) {
            $route = 'admin::edit-booklist-promos';
        }
        if ($this->booklists_types_id == 2) {
            $route = 'admin::edit-booklist-publicidades';
        }
        if ($this->booklists_types_id == 3) {
            $route = 'admin::edit-booklist-carousels';
        }
        if (Route::has($route)) {
            return route($route, $this->id);
        }

        return route('admin::dashboard');
    }
}
