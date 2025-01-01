<?php

namespace App\Repositories;

use App\Models\Category;
use DB;

class CategoryRepository
{

    public function getCategories($condition, $limit = 0, $sort = ['name', 'asc'])
    {
        $query = Category::select('*')->where($condition);

        if ($sort && count($sort) === 2) {
            $query->orderBy($sort[0], $sort[1]);
        }
    
        if ($limit > 0) {
            $query->limit($limit);
        }
    
        return $query->get();
    }

}
