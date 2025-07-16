<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\CategoryServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected CategoryService $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryService = new CategoryService();
    }

    public function test_can_get_all_categories()
    {
        // Create test categories
        Category::factory(5)->create();

        $request = new Request();
        $result = $this->categoryService->getAllCategories($request);

        $this->assertTrue($result['success']);
        $this->assertEquals('Data kategori berhasil diambil', $result['message']);
        $this->assertNotNull($result['data']);
        $this->assertEquals(5, $result['data']->total());
    }

    public function test_can_get_category_by_id()
    {
        $category = Category::factory()->create();

        $result = $this->categoryService->getCategoryById($category->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Data kategori berhasil diambil', $result['message']);
        $this->assertEquals($category->id, $result['data']->id);
    }

    public function test_returns_error_for_nonexistent_category()
    {
        $result = $this->categoryService->getCategoryById(999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Kategori tidak ditemukan', $result['message']);
        $this->assertNull($result['data']);
    }

    public function test_can_create_category()
    {
        $requestData = [
            'name' => 'Test Category',
            'description' => 'Test Description',
            'type' => 'Wishlist',
            'status' => true
        ];

        $request = new Request($requestData);
        $result = $this->categoryService->createCategory($request);

        $this->assertTrue($result['success']);
        $this->assertEquals('Kategori berhasil dibuat', $result['message']);
        $this->assertNotNull($result['data']);
        $this->assertEquals('Test Category', $result['data']->name);
        $this->assertEquals('Wishlist', $result['data']->type);
    }

    public function test_cannot_create_category_with_duplicate_name()
    {
        Category::factory()->create(['name' => 'Test Category']);

        $requestData = [
            'name' => 'Test Category',
            'description' => 'Test Description',
            'type' => 'Wishlist',
            'status' => true
        ];

        $request = new Request($requestData);
        $result = $this->categoryService->createCategory($request);

        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
    }

    public function test_can_update_category()
    {
        $category = Category::factory()->create();

        $requestData = [
            'name' => 'Updated Category',
            'description' => 'Updated Description',
            'type' => 'Wishlist',
            'status' => false
        ];

        $request = new Request($requestData);
        $result = $this->categoryService->updateCategory($request, $category->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Kategori berhasil diperbarui', $result['message']);
        $this->assertEquals('Updated Category', $result['data']->name);
        $this->assertEquals('Updated Description', $result['data']->description);
        $this->assertEquals('Wishlist', $result['data']->type);
        $this->assertFalse($result['data']->status);
    }

    public function test_cannot_update_nonexistent_category()
    {
        $requestData = [
            'name' => 'Updated Category',
            'description' => 'Updated Description',
            'type' => 'Wishlist',
            'status' => false
        ];

        $request = new Request($requestData);
        $result = $this->categoryService->updateCategory($request, 999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Kategori tidak ditemukan', $result['message']);
    }

    public function test_can_delete_category()
    {
        $category = Category::factory()->create();

        $result = $this->categoryService->deleteCategory($category->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Kategori berhasil dihapus', $result['message']);
        $this->assertNull($result['data']);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_cannot_delete_nonexistent_category()
    {
        $result = $this->categoryService->deleteCategory(999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Kategori tidak ditemukan', $result['message']);
    }
}
