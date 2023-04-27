<?php

namespace TypiCMS\Modules\Books\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Support\Str;

class FilterOrBooks implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if (is_array($value)) {
            $value = implode(',', $value);
        }

        $columns = explode(',', $property);

        //como odio este tipos de return con funciones en el medio

        return $query->where(function (Builder $query) use ($columns, $value) {
            foreach ($columns as $column) {
                if (in_array($column, (array) $query->getModel()->translatable)) {
                    $query->orWhereRaw(
                        'JSON_UNQUOTE(JSON_EXTRACT(`' . $column . '`, \'$.' . request('locale') . '\')) LIKE \'%' . $value . '%\' COLLATE ' . (DB::connection()->getConfig()['collation'] ?? 'utf8mb4_unicode_ci')
                    );
                } else {
                    if (Str::contains($column, 'author.fullname')) {
                        $query->orWhereHas('author', function (Builder $query) use ($value) {
                            $query->where(DB::raw('concat(first_name," ",last_name)'), 'LIKE', '%' . $value . '%');
                        });
                    } else {
                        $query->orWhere($column, 'like', '%' . $value . '%');
                    }
                }
            }
        });
    }
}
