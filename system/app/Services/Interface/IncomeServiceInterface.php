<?php

namespace App\Services\Interface;

use Illuminate\Http\Request;

interface IncomeServiceInterface
{
    /**
     * Get all incomes with pagination
     *
     * @param Request $request
     */
    public function getAllIncomes(Request $request);

    /**
     * Get income by ID
     *
     * @param int $id
     * @return array
     */
    public function getIncomeById(int $id): array;

    /**
     * Create new income
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request): array;

    /**
     * Update income
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, int $id): array;

    /**
     * Delete income
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array;
}
