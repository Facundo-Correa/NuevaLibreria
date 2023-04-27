<?php

namespace TypiCMS\Modules\Booklists\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use TypiCMS\Modules\Core\Models\Base;

class Booklisttype extends Base
{
    protected $guarded = [];

    protected $table = 'booklists_types';

    protected $fillable = [
        'name'
    ];

    public function lists(): HasMany
    {
        return $this->HasMany(Booklist::class);
    }
}
