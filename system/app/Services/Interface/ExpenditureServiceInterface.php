<?php

namespace App\Services\Interface;

use Illuminate\Http\Request;

interface ExpenditureServiceInterface
{
    /**
     * Get all expenditures with pagination
     *
     * @param Request $request
     */
    public function getAllExpenditures(Request $request);

    /**
     * Get expenditure by ID
     *
     * @param int $id
     * @return array
     */
    public function getExpenditureById(int $id): array;

    /**
     * Create new expenditure
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request): array;

    /**
     * Update expenditure
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, int $id): array;

    /**
     * Delete expenditure
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
