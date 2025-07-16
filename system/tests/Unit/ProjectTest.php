<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected ProjectService $projectService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->projectService = new ProjectService();
    }

    public function test_bisa_mendapatkan_semua_project()
    {
        Project::factory(5)->create();

        $request = new Request();
        $result = $this->projectService->getAllProjects($request);

        $this->assertNotNull($result);
        $this->assertEquals(5, $result->total());
    }

    public function test_bisa_mendapatkan_project_berdasarkan_id()
    {
        $project = Project::factory()->create();

        $result = $this->projectService->getProjectById($project->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Data kategori berhasil diambil', $result['message']);
        $this->assertEquals($project->id, $result['data']->id);
    }

    public function test_gagal_mendapatkan_project_yang_tidak_ada()
    {
        $result = $this->projectService->getProjectById(999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Kategori tidak ditemukan', $result['message']);
        $this->assertNull($result['data']);
    }

    public function test_bisa_membuat_project()
    {
        $request = new Request([
            'name' => 'Project Baru',
            'photo' => 'photo.jpg',
        ]);

        $result = $this->projectService->createProject($request);

        $this->assertTrue($result['success']);
        $this->assertEquals('Project berhasil dibuat', $result['message']);
        $this->assertNotNull($result['data']);
        $this->assertEquals('Project Baru', $result['data']->name);
        $this->assertEquals('photo.jpg', $result['data']->photo);
    }

    public function test_bisa_update_project()
    {
        $project = Project::factory()->create([
            'name' => 'Project Lama',
            'photo' => 'lama.jpg',
        ]);

        $request = new Request([
            'id' => $project->id,
            'name' => 'Project Update',
            'photo' => 'update.jpg',
        ]);

        $result = $this->projectService->updateProject($request, $project->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Project berhasil diupdate', $result['message']);
        $this->assertEquals('Project Update', $result['data']->name);
        $this->assertEquals('update.jpg', $result['data']->photo);
    }

    public function test_bisa_delete_project()
    {
        $project = Project::factory()->create();

        $result = $this->projectService->deleteProject($project->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Project berhasil dihapus', $result['message']);
        $this->assertNull(Project::find($project->id));
    }
}
