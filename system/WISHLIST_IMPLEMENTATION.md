# Implementasi Fitur Wishlist

## Deskripsi

Fitur CRUD Wishlist telah berhasil diimplementasikan dengan mengikuti pola yang sama seperti CategoryController dan CategoryService. Fitur ini memungkinkan pengguna untuk mengelola daftar keinginan produk dengan informasi lengkap.

## Field yang Tersedia

-   `category_id` - ID kategori produk (foreign key ke tabel categories)
-   `photo` - URL foto produk (nullable)
-   `name` - Nama produk
-   `price` - Harga produk
-   `qty` - Jumlah produk
-   `total_price` - Total harga (dihitung otomatis: price × qty)
-   `link_ecommerce` - Link ke e-commerce (nullable)

## File yang Dibuat

### 1. Model

-   `app/Models/Wishlist.php` - Model Wishlist dengan relationship ke Category

### 2. Migration

-   `database/migrations/2024_01_01_000000_create_wishlists_table.php` - Migration untuk tabel wishlists

### 3. Service Layer

-   `app/Services/WishlistServiceInterface.php` - Interface untuk WishlistService
-   `app/Services/WishlistService.php` - Service class dengan logika bisnis

### 4. Controller

-   `app/Http/Controllers/WishlistController.php` - Controller untuk menangani request HTTP

### 5. Views

-   `resources/views/wishlists/index.blade.php` - Halaman daftar wishlist
-   `resources/views/wishlists/add.blade.php` - Halaman tambah wishlist
-   `resources/views/wishlists/edit.blade.php` - Halaman edit wishlist

### 6. Factory & Seeder

-   `database/factories/WishlistFactory.php` - Factory untuk data testing
-   `database/seeders/WishlistSeeder.php` - Seeder untuk data dummy

### 7. Test

-   `tests/Unit/WishlistServiceTest.php` - Unit test untuk WishlistService

## Routes yang Tersedia

```php
// Wishlist routes
Route::prefix('wishlists')->controller(WishlistController::class)->name('wishlist.')->group(function () {
    Route::get('/', 'index');           // GET /wishlists
    Route::get('/add', 'add');          // GET /wishlists/add
    Route::post('/create', 'create');   // POST /wishlists/create
    Route::get('/edit/{id}', 'edit');   // GET /wishlists/edit/{id}
    Route::post('/update', 'update');   // POST /wishlists/update
    Route::post('/delete', 'delete');   // POST /wishlists/delete
});
```

## Fitur yang Tersedia

### 1. Daftar Wishlist (Index)

-   Menampilkan semua wishlist dengan pagination
-   Filter berdasarkan nama produk dan kategori
-   Menampilkan foto produk, nama, kategori, harga, jumlah, dan total harga
-   Tombol edit dan hapus untuk setiap item

### 2. Tambah Wishlist (Add)

-   Form untuk menambah wishlist baru
-   Dropdown untuk memilih kategori
-   Input untuk nama produk, harga, jumlah
-   Input untuk URL foto dan link e-commerce
-   Validasi form yang lengkap

### 3. Edit Wishlist (Edit)

-   Form untuk mengedit wishlist yang ada
-   Pre-filled dengan data yang sudah ada
-   Validasi yang sama dengan form tambah

### 4. Hapus Wishlist (Delete)

-   Konfirmasi sebelum menghapus
-   Soft delete atau hard delete (tergantung implementasi)

## Validasi yang Diterapkan

-   `category_id`: required, exists di tabel categories
-   `name`: required, string, max 255 karakter
-   `price`: required, numeric, min 0
-   `qty`: required, integer, min 1
-   `photo`: nullable, string (URL)
-   `link_ecommerce`: nullable, URL yang valid

## Perhitungan Otomatis

-   `total_price` dihitung otomatis: `price × qty`
-   Perhitungan dilakukan saat create dan update

## Relationship

-   Wishlist belongs to Category
-   Category has many Wishlists

## Service Binding

Service binding telah didaftarkan di `AppServiceProvider.php`:

```php
$this->app->bind(WishlistServiceInterface::class, WishlistService::class);
```

## Cara Penggunaan

### 1. Akses Halaman Wishlist

```
GET /wishlists
```

### 2. Tambah Wishlist Baru

```
GET /wishlists/add
POST /wishlists/create
```

### 3. Edit Wishlist

```
GET /wishlists/edit/{id}
POST /wishlists/update
```

### 4. Hapus Wishlist

```
POST /wishlists/delete
```

## Testing

Unit test telah dibuat untuk memastikan semua fungsi berjalan dengan benar:

-   Test untuk getAllWishlists
-   Test untuk getWishlistById (success dan not found)
-   Test untuk createWishlist (success dan validation error)
-   Test untuk updateWishlist (success dan not found)
-   Test untuk deleteWishlist (success dan not found)

## Catatan Penting

1. Pastikan tabel categories sudah ada sebelum menjalankan migration wishlists
2. Total price dihitung otomatis berdasarkan price dan qty
3. Foto produk menggunakan URL eksternal
4. Link e-commerce bersifat opsional
5. Semua operasi CRUD dilengkapi dengan error handling yang baik
