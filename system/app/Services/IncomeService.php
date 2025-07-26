<?php

namespace App\Services;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Services\Interface\IncomeServiceInterface;
use Illuminate\Support\Facades\DB;

class IncomeService implements IncomeServiceInterface
{
    public function getAllIncomes(Request $request)
    {
        return Income::orderByDesc('id')->paginate(10);
    }

    public function getIncomeById(int $id): array
    {
        $data = Income::findOrFail($id);
        return [
            'success' => true,
            'data' => $data
        ];
    }

    public function create(Request $request): array
    {
        try {
            return DB::transaction(function () use ($request) {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'date' => 'required|date',
                    'amount' => 'required',
                ]);
                $validated['amount'] = priceToInt($validated['amount']);
                $data = Income::create($validated);
                return [
                    'success' => true,
                    'data' => $data,
                    'url' => url('incomes'),
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

    public function update(Request $request, int $id): array
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'date' => 'required|date',
                    'amount' => 'required',
                ]);
                $validated['amount'] = priceToInt($validated['amount']);
                $data = Income::findOrFail($id);
                $data->update($validated);
                return [
                    'success' => true,
                    'data' => $data,
                    'url' => url('incomes'),
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

    public function delete(int $id): array
    {
        try {
            $data = Income::findOrFail($id);
            $data->delete();
            return [
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
