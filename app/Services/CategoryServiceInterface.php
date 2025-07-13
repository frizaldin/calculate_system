<?php

namespace App\Services;

use Illuminate\Http\Request;

interface CategoryServiceInterface
{
    /**
     * Get all categories with pagination
     *
     * @param Request $request
     */
    public function getAllCategories(Request $request);

    /**
     * Get category by ID
     *
     * @param int $id
     * @return array
     */
    public function getCategoryById(int $id): array;

    /**
     * Create new category
     *
     * @param Request $request
     * @return array
     */
    public function createCategory(Request $request): array;

    /**
     * Update category
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateCategory(Request $request, int $id): array;

    /**
     * Delete category
     *
     * @param int $id
     * @return array
     */
    public function deleteCategory(int $id): array;
}
