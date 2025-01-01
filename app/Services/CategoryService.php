<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Fetch a dynamic number of categories with related data.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ValidationException
     */
    public function getCategories(array $data)
    {
        // Validate input data
        $validated = $this->validateData('get', $data);
    
        $conditions = $validated['conditions'];

        $limit = $validated['limit'] ?? 0;

        $sort = $validated['sort'] ?? ['name', 'asc'];
    
        // Fetch the featured posts with the required conditions
        return $this->categoryRepository->getCategories($conditions, $limit, $sort);
    }

    /**
     * Validate input data for fetching categories.
     *
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    private function validateData($key, array $data)
    {
        $rules = [
            'get' => [
                'conditions' => 'required|array',
                'limit' => 'nullable|integer|min:0|max:100',
                'sort' => 'nullable|array'
            ]
        ];

        return validator($data, $rules[$key])->validate();
    }
}
