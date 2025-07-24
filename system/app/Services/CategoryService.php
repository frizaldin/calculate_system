<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\Interface\CategoryServiceInterface;

class CategoryService implements \App\Services\Interface\CategoryServiceInterface
{
    /**
     * Get all categories with pagination
     *
     * @param Request $request
     */
    public function getAllCategories(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $name = $request->get('name', '');
        $status = $request->get('status', '');
        $type = $request->get('type', '');

        $query = Category::query();

        if (!empty($name)) {
            $query->where(function ($q) use ($name) {
                $q->where('name', 'like', "%{$name}%")
                    ->orWhere('description', 'like', "%{$name}%");
            });
        }

        if ($status !== '') {
            $query->where('status', $status);
        }
        if ($type !== '') {
            $query->where('type', $type);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }


    /**
     * Get category by ID
     *
     * @param int $id
     * @return array
     */
    public function getCategoryById(int $id): array
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return [
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan',
                    'data' => null
                ];
            }

            return [
                'success' => true,
                'message' => 'Data kategori berhasil diambil',
                'data' => $category,
            ];
        } catch (Exception $e) {
            Log::error('Category getCategoryById error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kategori',
                'data' => null
            ];
        }
    }

    /**
     * Create new category
     *
     * @param Request $request
     * @return array
     */
    public function createCategory(Request $request): array
    {
        try {
            // Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string',
                'status' => 'boolean',
                'type' => 'required|in:Wishlist'
            ], [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.string' => 'Nama kategori harus berupa teks.',
                'name.max' => 'Nama kategori maksimal 255 karakter.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'description.string' => 'Deskripsi kategori harus berupa teks.',
                'status.boolean' => 'Status kategori harus berupa nilai benar atau salah.',
                'type.required' => 'Tipe kategori wajib diisi.',
                'type.in' => 'Tipe kategori harus berupa Wishlist.',
            ]);

            // Start database transaction
            DB::beginTransaction();

            try {
                $category = Category::create($validated);

                // Commit transaction
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Kategori berhasil dibuat',
                    'data' => $category,
                    'url' => url('categories')
                ];
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Category createCategory DB error: ' . $e->getMessage(), [
                    'data' => $validated,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Category createCategory error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat kategori',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Update category
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateCategory(Request $request, int $id): array
    {
        try {
            // Find category
            $category = Category::find($id);

            if (!$category) {
                return [
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan',
                    'data' => null
                ];
            }

            // Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
                'description' => 'nullable|string',
                'status' => 'boolean',
                'type' => 'required|in:Wishlist'
            ], [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.string' => 'Nama kategori harus berupa teks.',
                'name.max' => 'Nama kategori maksimal 255 karakter.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'description.string' => 'Deskripsi kategori harus berupa teks.',
                'status.boolean' => 'Status kategori harus berupa nilai benar atau salah.',
                'type.required' => 'Tipe kategori wajib diisi.',
                'type.in' => 'Tipe kategori harus berupa Wishlist.',
            ]);

            // Start database transaction
            DB::beginTransaction();

            try {
                $category->update($validated);

                // Commit transaction
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Kategori berhasil diperbarui',
                    'data' => $category->fresh(),
                    'url' => url('categories')
                ];
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Category updateCategory DB error: ' . $e->getMessage(), [
                    'id' => $id,
                    'data' => $validated,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Category updateCategory error: ' . $e->getMessage(), [
                'id' => $id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui kategori',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Delete category
     *
     * @param int $id
     * @return array
     */
    public function deleteCategory(int $id): array
    {
        try {
            // Find category
            $category = Category::find($id);

            if (!$category) {
                return [
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan',
                    'data' => null
                ];
            }

            // Start database transaction
            DB::beginTransaction();

            try {
                $category->delete();

                // Commit transaction
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Kategori berhasil dihapus',
                    'data' => null
                ];
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Category deleteCategory DB error: ' . $e->getMessage(), [
                    'id' => $id,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Category deleteCategory error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus kategori',
                'data' => null
            ];
        }
    }
}
