<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait SearchTrait
{
    public function search($query, $columns, $keyword, $paginate=false, $paginateBy=0)
    {
        foreach($columns as $column)
        {
            $query->orWhere($column, 'LIKE', '%'.$keyword.'%');
        }
        if ($paginate && ($paginateBy > 0))
        {
            return $query->orderBy('created_at', 'desc')->paginate($paginateBy);
        }
        return $query->get();
    }

    public function idRestrictedSearch($query, $columns, $keyword, $paginate=false, $paginateBy=0)
    {
        $query->where('user_id', Auth::id())->where(function ($query) use ($columns, $keyword){
            foreach($columns as $column)
            {
                $query->orWhere($column, 'LIKE', '%'.$keyword.'%');
            }
        });
        if ($paginate && ($paginateBy > 0))
        {
            return $query->paginate($paginateBy);
        }
        return $query->get();
    }
}
