<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\UploadService;

class ProjectService implements ProjectServiceInterface
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * Get all categories with pagination
     *
     * @param Request $request
     */
    public function getAllProjects(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $name = $request->get('name', '');
        $status = $request->get('status', '');
        $type = $request->get('type', '');

        $query = Project::query();

        if (!empty($name)) {
            $query->where(function ($q) use ($name) {
                $q->where('name', 'like', "%{$name}%")
                    ->orWhere('description', 'like', "%{$name}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }


    /**
     * Get Project by ID
     *
     * @param int $id
     * @return array
     */
    public function getProjectById(int $id): array
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return [
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan',
                    'data' => null
                ];
            }

            return [
                'success' => true,
                'message' => 'Data kategori berhasil diambil',
                'data' => $project,
            ];
        } catch (Exception $e) {
            Log::error('Project getProjectById error: ' . $e->getMessage(), [
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
     * Create new Project
     *
     * @param Request $request
     * @return array
     */
    public function createProject(Request $request): array
    {
        try {
            // Validasi request hanya untuk field name dan photo
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:projects,name',
                'photo' => 'nullable|image|max:2048', // opsional, max 2MB
            ], [
                'name.required' => 'Nama project wajib diisi.',
                'name.string' => 'Nama project harus berupa teks.',
                'name.max' => 'Nama project maksimal 255 karakter.',
                'name.unique' => 'Nama project sudah digunakan.',
                'photo.image' => 'Photo harus berupa file gambar.',
                'photo.max' => 'Ukuran photo maksimal 2MB.',
            ]);

            // Handle upload photo jika ada
            if ($request->hasFile('photo')) {
                $photoPath = $this->uploadService->upload($request->file('photo'), 'projects');
                $validated['photo'] = $photoPath;
            }

            // Mulai transaksi database
            DB::beginTransaction();

            try {
                $project = Project::create($validated);

                // Commit transaksi
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Project berhasil dibuat',
                    'data' => $project,
                    'url' => url('projects')
                ];
            } catch (Exception $e) {
                // Rollback transaksi jika error
                DB::rollBack();

                Log::error('Project createProject DB error: ' . $e->getMessage(), [
                    'data' => $validated,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Project createProject error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat project',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Update Project
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateProject(Request $request, int $id): array
    {
        try {
            // Cari Project
            $project = Project::find($id);

            if (!$project) {
                return [
                    'success' => false,
                    'message' => 'Project tidak ditemukan',
                    'data' => null
                ];
            }

            // Validasi request hanya untuk field name dan photo
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:projects,name,' . $id,
                'photo' => 'nullable|image|max:2048',
            ], [
                'name.required' => 'Nama project wajib diisi.',
                'name.string' => 'Nama project harus berupa teks.',
                'name.max' => 'Nama project maksimal 255 karakter.',
                'name.unique' => 'Nama project sudah digunakan.',
                'photo.image' => 'Photo harus berupa file gambar.',
                'photo.max' => 'Ukuran photo maksimal 2MB.',
            ]);

            // Handle upload photo jika ada
            if ($request->hasFile('photo')) {
                $photoPath = $this->uploadService->upload($request->file('photo'), 'projects');
                $validated['photo'] = $photoPath;
            }

            // Mulai transaksi database
            DB::beginTransaction();

            try {
                $project->update($validated);

                // Commit transaksi
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Project berhasil diperbarui',
                    'data' => $project->fresh(),
                    'url' => url('projects')
                ];
            } catch (Exception $e) {
                // Rollback transaksi jika error
                DB::rollBack();

                Log::error('Project updateProject DB error: ' . $e->getMessage(), [
                    'id' => $id,
                    'data' => $validated,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Project updateProject error: ' . $e->getMessage(), [
                'id' => $id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui project',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Delete Project
     *
     * @param int $id
     * @return array
     */
    public function deleteProject(int $id): array
    {
        try {
            // Find Project
            $project = Project::find($id);

            if (!$project) {
                return [
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan',
                    'data' => null
                ];
            }

            // Start database transaction
            DB::beginTransaction();

            try {
                $project->delete();

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

                Log::error('Project deleteProject DB error: ' . $e->getMessage(), [
                    'id' => $id,
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Project deleteProject error: ' . $e->getMessage(), [
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
