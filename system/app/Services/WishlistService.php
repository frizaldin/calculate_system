<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\Interface\WishlistServiceInterface;

class WishlistService implements \App\Services\Interface\WishlistServiceInterface
{
    /**
     * Get all wishlists with pagination
     *
     * @param Request $request
     */
    public function getAllWishlists(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $name = $request->get('name', '');
        $category_id = $request->get('category_id', '');

        $query = Wishlist::with('category');

        if (!empty($name)) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($category_id !== '') {
            $query->where('category_id', $category_id);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get wishlist by ID
     *
     * @param int $id
     * @return array
     */
    public function getWishlistById(int $id): array
    {
        try {
            $wishlist = Wishlist::with('category')->find($id);

            if (!$wishlist) {
                return [
                    'success' => false,
                    'message' => 'Wishlist tidak ditemukan',
                    'data' => null
                ];
            }

            return [
                'success' => true,
                'message' => 'Data wishlist berhasil diambil',
                'data' => $wishlist,
            ];
        } catch (Exception $e) {
            Log::error('Wishlist getWishlistById error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data wishlist',
                'data' => null
            ];
        }
    }

    /**
     * Create new wishlist
     *
     * @param Request $request
     * @return array
     */
    public function createWishlist(Request $request): array
    {
        try {
            // Validate request
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'photo' => 'nullable|string',
                'name' => 'required|string|max:255',
                'price' => 'required',
                'qty' => 'required|integer|min:1',
                'link_ecommerce' => 'nullable|url',
                'status' => 'nullable|in:wishlist,purchased'
            ], [
                'category_id.required' => 'Kategori wajib dipilih.',
                'category_id.exists' => 'Kategori yang dipilih tidak valid.',
                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 255 karakter.',
                'price.required' => 'Harga wajib diisi.',
                'qty.required' => 'Jumlah wajib diisi.',
                'qty.integer' => 'Jumlah harus berupa angka bulat.',
                'qty.min' => 'Jumlah minimal 1.',
                'link_ecommerce.url' => 'Link e-commerce harus berupa URL yang valid.',
                'status.in' => 'Status harus berupa wishlist atau purchased.',
            ]);

            // Set default status if not provided
            if (!isset($validated['status'])) {
                $validated['status'] = 'wishlist';
            }

            // Calculate total price
            $validated['price'] = priceToInt($validated['price']);
            $validated['total_price'] = $validated['price'] * $validated['qty'];

            // Start database transaction
            DB::beginTransaction();

            try {
                $wishlist = Wishlist::create($validated);

                // Commit transaction
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Wishlist berhasil dibuat',
                    'data' => $wishlist,
                    'url' => url('wishlists')
                ];
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Wishlist createWishlist DB error: ' . $e->getMessage(), [
                    'data' => $validated,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Wishlist createWishlist error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat wishlist',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Update wishlist
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateWishlist(Request $request, int $id): array
    {
        try {
            // Find wishlist
            $wishlist = Wishlist::find($id);

            if (!$wishlist) {
                return [
                    'success' => false,
                    'message' => 'Wishlist tidak ditemukan',
                    'data' => null
                ];
            }

            // Validate request
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'photo' => 'nullable|string',
                'name' => 'required|string|max:255',
                'price' => 'required',
                'qty' => 'required|integer|min:1',
                'link_ecommerce' => 'nullable|url',
                'status' => 'nullable|in:wishlist,purchased'
            ], [
                'category_id.required' => 'Kategori wajib dipilih.',
                'category_id.exists' => 'Kategori yang dipilih tidak valid.',
                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 255 karakter.',
                'price.required' => 'Harga wajib diisi.',
                'qty.required' => 'Jumlah wajib diisi.',
                'qty.integer' => 'Jumlah harus berupa angka bulat.',
                'qty.min' => 'Jumlah minimal 1.',
                'link_ecommerce.url' => 'Link e-commerce harus berupa URL yang valid.',
                'status.in' => 'Status harus berupa wishlist atau purchased.',
            ]);

            // Set default status if not provided
            if (!isset($validated['status'])) {
                $validated['status'] = 'wishlist';
            }

            // Calculate total price
            $validated['price'] = priceToInt($validated['price']);
            $validated['total_price'] = $validated['price'] * $validated['qty'];

            // Start database transaction
            DB::beginTransaction();

            try {
                $wishlist->update($validated);

                // Commit transaction
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Wishlist berhasil diperbarui',
                    'data' => $wishlist->fresh(),
                    'url' => url('wishlists')
                ];
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Wishlist updateWishlist DB error: ' . $e->getMessage(), [
                    'id' => $id,
                    'data' => $validated,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Wishlist updateWishlist error: ' . $e->getMessage(), [
                'id' => $id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui wishlist',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Delete wishlist
     *
     * @param int $id
     * @return array
     */
    public function deleteWishlist(int $id): array
    {
        try {
            // Find wishlist
            $wishlist = Wishlist::find($id);

            if (!$wishlist) {
                return [
                    'success' => false,
                    'message' => 'Wishlist tidak ditemukan',
                    'data' => null
                ];
            }

            // Start database transaction
            DB::beginTransaction();

            try {
                $wishlist->delete();

                // Commit transaction
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Wishlist berhasil dihapus',
                    'data' => null
                ];
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Wishlist deleteWishlist DB error: ' . $e->getMessage(), [
                    'id' => $id,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Wishlist deleteWishlist error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus wishlist',
                'data' => null
            ];
        }
    }
}
