<?php

namespace App\Services;

use App\Models\MonthlyFinance;
use Illuminate\Http\Request;
use App\Services\Interface\MonthlyFinanceServiceInterface;

class MonthlyFinanceService implements \App\Services\Interface\MonthlyFinanceServiceInterface
{
    /**
     * Get all monthly finances with pagination
     *
     * @param Request $request
     */
    public function getAllMonthlyFinances(Request $request)
    {
        // Bisa ditambah filter/pagination jika perlu
        return MonthlyFinance::orderByDesc('id')->paginate(10);
    }

    /**
     * Get monthly finance by ID
     *
     * @param int $id
     * @return array
     */
    public function getMonthlyFinanceById(int $id): array
    {
        $data = MonthlyFinance::findOrFail($id);
        return [
            'success' => true,
            'data' => $data
        ];
    }

    /**
     * Create new monthly finance
     *
     * @param Request $request
     * @return array
     */
    public function createMonthlyFinance(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'installments' => 'nullable|integer',
            'billed_date' => 'required|date',
            'type' => 'required|in:Temporary,Permanent',
            'amount' => 'required|numeric',
            'status' => 'required|in:Done,On Going',
        ]);
        $data = MonthlyFinance::create($validated);
        return [
            'success' => true,
            'data' => $data,
            'message' => 'Data berhasil ditambahkan.'
        ];
    }

    /**
     * Update monthly finance
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateMonthlyFinance(Request $request, int $id): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'installments' => 'nullable|integer',
            'billed_date' => 'required|date',
            'type' => 'required|in:Temporary,Permanent',
            'amount' => 'required|numeric',
            'status' => 'required|in:Done,On Going',
        ]);
        $data = MonthlyFinance::findOrFail($id);
        $data->update($validated);
        return [
            'success' => true,
            'data' => $data,
            'message' => 'Data berhasil diupdate.'
        ];
    }

    /**
     * Delete monthly finance
     *
     * @param int $id
     * @return array
     */
    public function deleteMonthlyFinance(int $id): array
    {
        $data = MonthlyFinance::findOrFail($id);
        $data->delete();
        return [
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ];
    }
}
