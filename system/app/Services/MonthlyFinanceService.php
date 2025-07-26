<?php

namespace App\Services;

use App\Models\Expenditure;
use App\Models\MonthlyFinance;
use Illuminate\Http\Request;
use App\Services\Interface\MonthlyFinanceServiceInterface;
use Illuminate\Support\Facades\DB;

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
    public function create(Request $request): array
    {
        try {
            return DB::transaction(function () use ($request) {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'installments' => 'nullable|integer',
                    'billed_day' => 'required|integer|min:1|max:31',
                    'frequently' => 'required|in:Yearly,Monthly',
                    'type' => 'required|in:Temporary,Permanent',
                    'amount' => 'required',
                    'status' => 'required|in:Done,On Going',
                ]);
                $validated['amount'] = priceToInt($validated['amount']);
                $data = MonthlyFinance::create($validated);
                return [
                    'success' => true,
                    'data' => $data,
                    'url' => url('monthly_finances'),
                    'message' => 'Data berhasil ditambahkan.'
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update monthly finance
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, int $id): array
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'installments' => 'nullable|integer',
                    'billed_day' => 'required|integer|min:1|max:31',
                    'frequently' => 'required|in:Yearly,Monthly',
                    'type' => 'required|in:Temporary,Permanent',
                    'amount' => 'required',
                    'status' => 'required|in:Done,On Going',
                ]);
                $validated['amount'] = priceToInt($validated['amount']);
                $data = MonthlyFinance::findOrFail($id);
                $data->update($validated);
                return [
                    'success' => true,
                    'data' => $data,
                    'url' => url('monthly_finances'),
                    'message' => 'Data berhasil diupdate.'
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Delete monthly finance
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        try {
            return DB::transaction(function () use ($id) {
                $data = MonthlyFinance::findOrFail($id);
                $data->delete();
                return [
                    'success' => true,
                    'message' => 'Data berhasil dihapus.'
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Delete monthly finance
     *
     * @param int $id
     * @return array
     */
    public function payBill(int $id): array
    {
        try {
            return DB::transaction(function () use ($id) {
                $data = MonthlyFinance::findOrFail($id);

                // Masukkan data ke tabel expenditure berdasarkan data monthly finance yang dibayar
                Expenditure::create([
                    'purpose' => 'Pembayaran' . $data->title,
                    'amount' => $data->amount,
                    'date' => now(),
                    'monthly_finance_id' => $data->id,
                ]);
                return [
                    'success' => true,
                    'message' => 'Pembayaran telah di lakukan.'
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
