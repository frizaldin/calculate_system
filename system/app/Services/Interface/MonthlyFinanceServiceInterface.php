<?php

namespace App\Services\Interface;

use Illuminate\Http\Request;

interface MonthlyFinanceServiceInterface
{
    /**
     * Get all monthly finances with pagination
     *
     * @param Request $request
     */
    public function getAllMonthlyFinances(Request $request);

    /**
     * Get monthly finance by ID
     *
     * @param int $id
     * @return array
     */
    public function getMonthlyFinanceById(int $id): array;

    /**
     * Create new monthly finance
     *
     * @param Request $request
     * @return array
     */
    public function createMonthlyFinance(Request $request): array;

    /**
     * Update monthly finance
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateMonthlyFinance(Request $request, int $id): array;

    /**
     * Delete monthly finance
     *
     * @param int $id
     * @return array
     */
    public function deleteMonthlyFinance(int $id): array;
}
