# Category Implementation Documentation

## Overview

Implementasi sistem kategori dengan fitur CRUD lengkap menggunakan Laravel dengan arsitektur Service Pattern.

## Database Schema

### Categories Table

```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    type ENUM('Wishlist') DEFAULT 'Wishlist' NOT NULL,
    status BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Fields

-   **id**: Primary key auto increment
-   **name**: Nama kategori (required, unique)
-   **description**: Deskripsi kategori (optional)
-   **type**: Tipe kategori dengan enum 'Wishlist' (required)
-   **status**: Status aktif/nonaktif (boolean, default: true)
-   **created_at**: Timestamp pembuatan
-   **updated_at**: Timestamp update

## Architecture

### Service Pattern

Menggunakan Service Pattern untuk memisahkan business logic dari controller:

```
app/
├── Services/
│   ├── CategoryServiceInterface.php    # Interface
│   └── CategoryService.php             # Implementation
├── Http/Controllers/
│   └── CategoryController.php          # Controller
└── Models/
    └── Category.php                    # Model
```

### Service Interface

```php
interface CategoryServiceInterface
{
    public function getAllCategories(Request $request);
    public function getCategoryById(int $id): array;
    public function createCategory(Request $request): array;
    public function updateCategory(Request $request, int $id): array;
    public function deleteCategory(int $id): array;
}
```

## Features

### 1. CRUD Operations

-   **Create**: Membuat kategori baru dengan validasi
-   **Read**: Mengambil semua kategori dengan pagination dan filter
-   **Update**: Memperbarui kategori yang ada
-   **Delete**: Menghapus kategori

### 2. Filtering & Search

-   Filter berdasarkan nama/deskripsi (search)
-   Filter berdasarkan status (aktif/nonaktif)
-   Filter berdasarkan type (Wishlist)

### 3. Validation

```php
// Create/Update Validation Rules
'name' => 'required|string|max:255|unique:categories,name',
'description' => 'nullable|string',
'type' => 'required|in:Wishlist',
'status' => 'boolean'
```

### 4. Helper Functions

#### Type Helpers

```php
// Get type options for dropdown
type_options() // ['', 'Wishlist']

// Get type options for radio button
type_radio_options() // ['Wishlist']

// Convert type to text
type_text('Wishlist') // 'Wishlist'

// Convert type to badge HTML
type_badge('Wishlist') // '<span class="badge bg-info">Wishlist</span>'
```

#### Status Helpers

```php
// Get status options for dropdown
status_options() // ['', '1', '0']

// Get status options for radio button
status_radio_options() // ['1', '0']

// Convert status to text
status_text(true) // 'Aktif'

// Convert status to badge HTML
status_badge(true) // '<span class="badge bg-success">Aktif</span>'
```

## API Endpoints

### GET /categories

Mengambil semua kategori dengan pagination dan filter.

**Query Parameters:**

-   `per_page`: Jumlah item per halaman (default: 10)
-   `name`: Filter berdasarkan nama/deskripsi
-   `status`: Filter berdasarkan status (1/0)
-   `type`: Filter berdasarkan type (Wishlist)

**Response:**

```json
{
    "success": true,
    "message": "Data kategori berhasil diambil",
    "data": {
        "current_page": 1,
        "data": [...],
        "total": 10
    }
}
```

### POST /categories/create

Membuat kategori baru.

**Request Body:**

```json
{
    "name": "Electronics",
    "description": "Electronic products",
    "type": "Wishlist",
    "status": true
}
```

**Response:**

```json
{
    "success": true,
    "message": "Kategori berhasil dibuat",
    "data": {
        "id": 1,
        "name": "Electronics",
        "description": "Electronic products",
        "type": "Wishlist",
        "status": true,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    },
    "url": "http://localhost/categories"
}
```

### GET /categories/{id}

Mengambil kategori berdasarkan ID.

**Response:**

```json
{
    "success": true,
    "message": "Data kategori berhasil diambil",
    "data": {
        "id": 1,
        "name": "Electronics",
        "description": "Electronic products",
        "type": "Wishlist",
        "status": true,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### POST /categories/update

Memperbarui kategori.

**Request Body:**

```json
{
    "id": 1,
    "name": "Updated Electronics",
    "description": "Updated description",
    "type": "Wishlist",
    "status": false
}
```

**Response:**

```json
{
    "success": true,
    "message": "Kategori berhasil diperbarui",
    "data": {
        "id": 1,
        "name": "Updated Electronics",
        "description": "Updated description",
        "type": "Wishlist",
        "status": false,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    },
    "url": "http://localhost/categories"
}
```

### POST /categories/delete

Menghapus kategori.

**Request Body:**

```json
{
    "id": 1
}
```

**Response:**

```json
{
    "success": true,
    "message": "Kategori berhasil dihapus",
    "data": null
}
```

## Frontend Implementation

### Views

#### Index Page (`resources/views/categories/index.blade.php`)

-   Tabel dengan pagination
-   Filter berdasarkan name, status, dan type
-   Action buttons (edit, delete)

#### Add Page (`resources/views/categories/add.blade.php`)

-   Form untuk membuat kategori baru
-   Validation client-side dan server-side

#### Edit Page (`resources/views/categories/edit.blade.php`)

-   Form untuk mengedit kategori
-   Pre-filled dengan data existing

### JavaScript

#### Form Submission (`public/js/post/post.js`)

-   AJAX form submission
-   SweetAlert2 untuk notifikasi
-   Error handling

#### Status Helper (`public/js/status-helper.js`)

-   Helper functions untuk status
-   Convert form status values

## Database Transactions

Semua operasi write (create, update, delete) menggunakan database transaction:

```php
DB::beginTransaction();
try {
    // Perform operation
    DB::commit();
} catch (Exception $e) {
    DB::rollBack();
    throw $e;
}
```

## Error Handling

### Validation Errors

```json
{
    "success": false,
    "message": "Terjadi kesalahan saat membuat kategori",
    "errors": {
        "name": ["Nama kategori wajib diisi."],
        "type": ["Tipe kategori wajib diisi."]
    }
}
```

### System Errors

```json
{
    "success": false,
    "message": "Terjadi kesalahan sistem",
    "errors": {
        "general": ["Terjadi kesalahan sistem"]
    }
}
```

## Logging

Semua error dicatat dalam log dengan detail lengkap:

```php
Log::error('Category createCategory error: ' . $e->getMessage(), [
    'request_data' => $request->all(),
    'trace' => $e->getTraceAsString()
]);
```

## Testing

### Unit Tests (`tests/Unit/CategoryServiceTest.php`)

Test cases:

-   `test_can_get_all_categories()`
-   `test_can_get_category_by_id()`
-   `test_returns_error_for_nonexistent_category()`
-   `test_can_create_category()`
-   `test_cannot_create_category_with_duplicate_name()`
-   `test_can_update_category()`
-   `test_cannot_update_nonexistent_category()`
-   `test_can_delete_category()`
-   `test_cannot_delete_nonexistent_category()`

### Running Tests

```bash
php artisan test --filter=CategoryServiceTest
```

## Factory & Seeder

### Factory (`database/factories/CategoryFactory.php`)

```php
Category::factory()->create([
    'name' => 'Electronics',
    'description' => 'Electronic products',
    'type' => 'Wishlist',
    'status' => true
]);
```

### Seeder (`database/seeders/CategorySeeder.php`)

Membuat 8 kategori default dengan type 'Wishlist'.

## Migration

### Create Categories Table

```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->enum('type', ['Wishlist'])->default('Wishlist');
    $table->boolean('status')->default(true);
    $table->timestamps();
});
```

## Model Relationships

### Category Model

```php
class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'status'
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
```

## Security Features

1. **CSRF Protection**: Semua form menggunakan CSRF token
2. **Input Validation**: Server-side validation untuk semua input
3. **SQL Injection Prevention**: Menggunakan Eloquent ORM
4. **XSS Prevention**: Output escaping di views

## Performance Optimization

1. **Database Indexing**: Index pada kolom yang sering di-filter
2. **Pagination**: Menggunakan Laravel pagination
3. **Eager Loading**: Menggunakan `with()` untuk relationships
4. **Caching**: Cache untuk data yang jarang berubah

## Maintenance

### Adding New Type Values

Untuk menambahkan type baru:

1. **Update Migration**

```php
$table->enum('type', ['Wishlist', 'NewType'])->default('Wishlist');
```

2. **Update Validation**

```php
'type' => 'required|in:Wishlist,NewType'
```

3. **Update Helper Functions**

```php
function type_options(): array
{
    return [
        '' => 'Semua Tipe',
        'Wishlist' => 'Wishlist',
        'NewType' => 'New Type'
    ];
}
```

4. **Update Factory**

```php
'type' => fake()->randomElement(['Wishlist', 'NewType'])
```

5. **Update Seeder**

```php
'type' => 'Wishlist' // atau 'NewType'
```

## Troubleshooting

### Common Issues

1. **Validation Error**: Pastikan semua field required terisi
2. **Duplicate Name**: Nama kategori harus unique
3. **Type Error**: Type harus berupa 'Wishlist'
4. **Database Error**: Cek koneksi database dan migration

### Debug Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear

# Reset database
php artisan migrate:fresh --seed

# Check routes
php artisan route:list

# Check logs
tail -f storage/logs/laravel.log
```

## Future Enhancements

1. **Soft Delete**: Implementasi soft delete untuk kategori
2. **Audit Trail**: Log perubahan kategori
3. **Bulk Operations**: Import/export kategori
4. **API Versioning**: Version control untuk API
5. **Rate Limiting**: Rate limiting untuk API endpoints
6. **Caching**: Redis caching untuk performance
7. **Search**: Full-text search dengan Elasticsearch
8. **Export**: Export ke Excel/PDF
9. **Import**: Import dari Excel/CSV
10. **Notifications**: Email notifications untuk perubahan
