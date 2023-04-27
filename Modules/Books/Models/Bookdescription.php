<?php

namespace TypiCMS\Modules\Books\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use TypiCMS\Modules\Core\Models\Base;

class Bookdescription extends Base
{

    protected $guarded = [];

    protected $table = 'book_descriptions';

    protected $fillable = [
        'book_id',
        'description',
        'indice'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
