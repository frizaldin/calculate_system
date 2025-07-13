# Services Documentation

## AuthService

Service untuk menangani autentikasi pengguna.

### Methods:

-   `signin(Request $request): array` - Login user
-   `logout(): array` - Logout user
-   `isAuthenticated(): bool` - Cek status autentikasi
-   `getCurrentUser(): ?User` - Ambil user yang sedang login

## CategoryService

Service untuk menangani operasi CRUD kategori dengan fitur:

-   Database transaction
-   Try-catch error handling
-   Logging untuk debugging
-   Validation
-   JSON response untuk AJAX

### Methods:

#### `getAllCategories(Request $request): array`

Mengambil semua kategori dengan pagination dan filter.

**Parameters:**

-   `per_page` (optional): Jumlah item per halaman (default: 10)
-   `search` (optional): Pencarian berdasarkan nama atau deskripsi
-   `status` (optional): Filter berdasarkan status (true/false)

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

#### `getCategoryById(int $id): array`

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
        "status": true,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### `createCategory(Request $request): array`

Membuat kategori baru.

**Validation Rules:**

-   `name`: required, string, max:255, unique
-   `description`: nullable, string
-   `status`: boolean

**Response:**

```json
{
    "success": true,
    "message": "Kategori berhasil dibuat",
    "data": {
        "id": 1,
        "name": "Electronics",
        "description": "Electronic products",
        "status": true,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### `updateCategory(Request $request, int $id): array`

Memperbarui kategori.

**Validation Rules:**

-   `name`: required, string, max:255, unique (except current record)
-   `description`: nullable, string
-   `status`: boolean

**Response:**

```json
{
    "success": true,
    "message": "Kategori berhasil diperbarui",
    "data": {
        "id": 1,
        "name": "Updated Electronics",
        "description": "Updated description",
        "status": false,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### `deleteCategory(int $id): array`

Menghapus kategori.

**Response:**

```json
{
    "success": true,
    "message": "Kategori berhasil dihapus",
    "data": null
}
```

### Error Response Format

Semua method mengembalikan error dalam format yang konsisten:

```json
{
    "success": false,
    "message": "Pesan error",
    "errors": {
        "field_name": ["Error message"]
    }
}
```

### Database Transaction

Semua operasi write (create, update, delete) menggunakan database transaction untuk memastikan konsistensi data. Jika terjadi error, transaction akan di-rollback.

### Logging

Semua error dicatat dalam log dengan detail yang lengkap untuk memudahkan debugging.

### Usage Example

```php
// Di Controller
public function store(Request $request)
{
    $result = $this->categoryService->createCategory($request);
    return response()->json($result);
}
```

### AJAX Integration

Service ini dirancang untuk digunakan dengan AJAX. Semua response dalam format JSON dan dapat langsung digunakan di frontend JavaScript.
