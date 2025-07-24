<?php

namespace App\Services;

use App\Models\MonthlyFinance;
use Illuminate\Http\Request;

class MonthlyFinanceService implements MonthlyFinanceServiceInterface
{
    public function getAllMonthlyFinances(Request $request)
    {
        // Bisa ditambah filter/pagination jika perlu
        return MonthlyFinance::orderByDesc('id')->paginate(10);
    }

    public function getMonthlyFinanceById($id)
    {
        $data = MonthlyFinance::findOrFail($id);
        return [
            'success' => true,
            'data' => $data
        ];
    }

    public function createMonthlyFinance(Request $request)
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

    public function updateMonthlyFinance(Request $request, $id)
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

    public function deleteMonthlyFinance($id)
    {
        $data = MonthlyFinance::findOrFail($id);
        $data->delete();
        return [
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ];
    }
}
