<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Wishlist;
use App\Services\WishlistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class WishlistServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $wishlistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->wishlistService = new WishlistService();
    }

    public function test_get_all_wishlists()
    {
        // Create test data
        $category = Category::factory()->create();
        Wishlist::factory(5)->create(['category_id' => $category->id]);

        $request = new Request();
        $result = $this->wishlistService->getAllWishlists($request);

        $this->assertCount(5, $result);
    }

    public function test_get_wishlist_by_id_success()
    {
        $category = Category::factory()->create();
        $wishlist = Wishlist::factory()->create(['category_id' => $category->id]);

        $result = $this->wishlistService->getWishlistById($wishlist->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Data wishlist berhasil diambil', $result['message']);
        $this->assertEquals($wishlist->id, $result['data']->id);
    }

    public function test_get_wishlist_by_id_not_found()
    {
        $result = $this->wishlistService->getWishlistById(999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Wishlist tidak ditemukan', $result['message']);
        $this->assertNull($result['data']);
    }

    public function test_create_wishlist_success()
    {
        $category = Category::factory()->create();

        $request = new Request([
            'category_id' => $category->id,
            'name' => 'Test Product',
            'price' => 100000,
            'qty' => 2,
            'photo' => 'https://example.com/image.jpg',
            'link_ecommerce' => 'https://example.com/product'
        ]);

        $result = $this->wishlistService->createWishlist($request);

        $this->assertTrue($result['success']);
        $this->assertEquals('Wishlist berhasil dibuat', $result['message']);
        $this->assertEquals('Test Product', $result['data']->name);
        $this->assertEquals(200000, $result['data']->total_price);
    }

    public function test_create_wishlist_validation_error()
    {
        $request = new Request([
            'name' => '', // Empty name should fail validation
            'price' => -100, // Negative price should fail validation
        ]);

        $result = $this->wishlistService->createWishlist($request);

        $this->assertFalse($result['success']);
        $this->assertEquals('Terjadi kesalahan saat membuat wishlist', $result['message']);
    }

    public function test_update_wishlist_success()
    {
        $category = Category::factory()->create();
        $wishlist = Wishlist::factory()->create(['category_id' => $category->id]);

        $request = new Request([
            'id' => $wishlist->id,
            'category_id' => $category->id,
            'name' => 'Updated Product',
            'price' => 150000,
            'qty' => 3,
            'photo' => 'https://example.com/updated-image.jpg',
            'link_ecommerce' => 'https://example.com/updated-product'
        ]);

        $result = $this->wishlistService->updateWishlist($request, $wishlist->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Wishlist berhasil diperbarui', $result['message']);
        $this->assertEquals('Updated Product', $result['data']->name);
        $this->assertEquals(450000, $result['data']->total_price);
    }

    public function test_update_wishlist_not_found()
    {
        $request = new Request([
            'name' => 'Updated Product',
            'price' => 150000,
            'qty' => 3,
        ]);

        $result = $this->wishlistService->updateWishlist($request, 999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Wishlist tidak ditemukan', $result['message']);
    }

    public function test_delete_wishlist_success()
    {
        $category = Category::factory()->create();
        $wishlist = Wishlist::factory()->create(['category_id' => $category->id]);

        $result = $this->wishlistService->deleteWishlist($wishlist->id);

        $this->assertTrue($result['success']);
        $this->assertEquals('Wishlist berhasil dihapus', $result['message']);
        $this->assertNull($result['data']);
        $this->assertDatabaseMissing('wishlists', ['id' => $wishlist->id]);
    }

    public function test_delete_wishlist_not_found()
    {
        $result = $this->wishlistService->deleteWishlist(999);

        $this->assertFalse($result['success']);
        $this->assertEquals('Wishlist tidak ditemukan', $result['message']);
    }
}
