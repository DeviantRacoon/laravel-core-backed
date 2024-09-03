<?php

namespace App\Utils;

use \Illuminate\Database\Eloquent\Builder;
use App\Modules\Core\Application\Models\User;

class PaginationHelper
{
    public static function paginate(Builder $query, int|null $perPage, $model)
    {
        $limit = $perPage ?? $query->paginate()->total();
        $queryPaginate = $query->paginate($limit);

        $items = [];
        foreach ($queryPaginate->items() as $page) {
            $items[] = new $model((object)($page->toArray()));
        }
        
        return [
            "items" => $items,
            "total" => $queryPaginate->total(),
            "page" => $queryPaginate->currentPage(),
            "per_page" => $queryPaginate->perPage(),
        ];
    }
}
