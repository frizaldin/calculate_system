<?php

namespace App\Services;

use App\Models\Expenditure;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Services\Interface\ExpenditureServiceInterface;
use Illuminate\Support\Facades\DB;

class ExpenditureService implements ExpenditureServiceInterface
{
    public function getAllExpenditures(Request $request)
    {
        return Expenditure::orderByDesc('id')->paginate(10);
    }

    public function getExpenditureById(int $id): array
    {
        $data = Expenditure::findOrFail($id);
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
                    'purpose' => 'required|string|max:255',
                    'date' => 'required|date',
                    'amount' => 'required',
                    'wishlist_id' => 'nullable|exists:wishlists,id',
                    'monthly_finance_id' => 'nullable|exists:monthly_finances,id',
                ]);

                if (isset($validated['wishlist_id'])) {
                    $wishlist = Wishlist::findOrFail($validated['wishlist_id']);
                    $wishlist->status = 'purchased';
                    $wishlist->save();
                }

                $validated['amount'] = priceToInt($validated['amount']);
                $data = Expenditure::create($validated);
                return [
                    'success' => true,
                    'data' => $data,
                    'url' => url('expenditures'),
                    'message' => 'Data berhasil ditambahkan.'
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ];
        }
    }

    public function update(Request $request, int $id): array
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $validated = $request->validate([
                    'purpose' => 'required|string|max:255',
                    'date' => 'required|date',
                    'amount' => 'required',
                    'wishlist_id' => 'nullable|exists:wishlists,id',
                    'monthly_finance_id' => 'nullable|exists:monthly_finances,id',
                ]);
                $validated['amount'] = priceToInt($validated['amount']);
                $data = Expenditure::findOrFail($id);
                $data->update($validated);
                return [
                    'success' => true,
                    'data' => $data,
                    'url' => url('expenditures'),
                    'message' => 'Data berhasil diupdate.'
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ];
        }
    }

    public function delete(int $id): array
    {
        try {
            $data = Expenditure::findOrFail($id);
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
