<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Books\Presenters\ModulePresenter;

// || Extiende base para indexUrl()
class Inicio extends Base
{
    use HasFactory;use HasFiles;
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'exposicion',
        'nuestra_editorial',
        'sobre_nosotros',
    ];
}
