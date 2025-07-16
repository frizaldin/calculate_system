<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel Category Management System

Sistem manajemen kategori dengan implementasi CRUD lengkap menggunakan Laravel 12, service pattern, dan AJAX.

## Fitur Utama

-   ✅ **CRUD Operations**: Create, Read, Update, Delete kategori
-   ✅ **Service Pattern**: Menggunakan service layer untuk business logic
-   ✅ **Database Transaction**: Semua operasi write menggunakan transaction
-   ✅ **Try-Catch Error Handling**: Error handling yang komprehensif
-   ✅ **JSON Response**: Response dalam format JSON untuk AJAX
-   ✅ **Validation**: Validasi input yang robust
-   ✅ **Logging**: Logging untuk debugging
-   ✅ **Interface**: Dependency injection dengan interface
-   ✅ **Unit Testing**: Test coverage untuk service layer
-   ✅ **AJAX Integration**: Frontend JavaScript untuk interaksi real-time

## Struktur File

```
app/
├── Http/Controllers/
│   └── CategoryController.php          # Controller dengan CRUD methods
├── Models/
│   └── Category.php                   # Model Category dengan scopes
├── Services/
│   ├── CategoryService.php            # Business logic untuk kategori
│   ├── CategoryServiceInterface.php   # Interface untuk dependency injection
│   ├── AuthService.php               # Service autentikasi
│   └── AuthServiceInterface.php      # Interface autentikasi
├── Providers/
│   └── AppServiceProvider.php        # Service binding
└── View/Components/                   # Blade components

database/
├── migrations/
│   └── 2024_01_01_000000_create_categories_table.php
├── factories/
│   └── CategoryFactory.php           # Factory untuk testing
└── seeders/

resources/views/
└── categories/
    └── index.blade.php              # View untuk halaman kategori

public/js/
└── category.js                      # JavaScript untuk AJAX

tests/Unit/
└── CategoryServiceTest.php          # Unit tests

routes/
└── web.php                         # Route definitions
```

## API Endpoints

### Categories

| Method | Endpoint                | Description                                        |
| ------ | ----------------------- | -------------------------------------------------- |
| GET    | `/categories`           | Menampilkan halaman kategori atau data JSON (AJAX) |
| GET    | `/categories/create`    | Form tambah kategori                               |
| POST   | `/categories`           | Menyimpan kategori baru                            |
| GET    | `/categories/{id}`      | Detail kategori                                    |
| GET    | `/categories/{id}/edit` | Form edit kategori                                 |
| PUT    | `/categories/{id}`      | Update kategori                                    |
| DELETE | `/categories/{id}`      | Hapus kategori                                     |

## Response Format

### Success Response

```json
{
    "success": true,
    "message": "Pesan sukses",
    "data": {
        // Data kategori atau null
    }
}
```

### Error Response

```json
{
    "success": false,
    "message": "Pesan error",
    "errors": {
        "field_name": ["Error message"]
    }
}
```

## Database Schema

### Table: categories

```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    status BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## Service Layer

### CategoryService

Service ini menangani semua operasi CRUD untuk kategori dengan fitur:

-   **Database Transaction**: Semua operasi write menggunakan transaction
-   **Error Handling**: Try-catch dengan logging
-   **Validation**: Input validation dengan custom rules
-   **Pagination**: Support pagination dan filtering
-   **Search**: Pencarian berdasarkan nama dan deskripsi

### Methods

1. **getAllCategories(Request $request): array**

    - Mengambil semua kategori dengan pagination
    - Support search dan filter status
    - Parameter: `per_page`, `search`, `status`

2. **getCategoryById(int $id): array**

    - Mengambil kategori berdasarkan ID
    - Return error jika tidak ditemukan

3. **createCategory(Request $request): array**

    - Membuat kategori baru
    - Validation: name (required, unique), description (optional), status (boolean)

4. **updateCategory(Request $request, int $id): array**

    - Update kategori existing
    - Validation: name (required, unique except current), description (optional), status (boolean)

5. **deleteCategory(int $id): array**
    - Hapus kategori
    - Return error jika tidak ditemukan

## Frontend Integration

### JavaScript (category.js)

Class `CategoryManager` menyediakan:

-   **AJAX Methods**: getAllCategories, createCategory, updateCategory, deleteCategory
-   **Form Handling**: Auto-handle form submit untuk create dan update
-   **Event Listeners**: Click handlers untuk edit dan delete
-   **Error Display**: Validation error display
-   **Success/Error Messages**: Notification system

### Usage Example

```javascript
// Initialize
const categoryManager = new CategoryManager();

// Load categories
categoryManager.loadCategories();

// Create category
const formData = {
    name: "Electronics",
    description: "Electronic products",
    status: true,
};
const result = await categoryManager.createCategory(formData);
```

## Installation & Setup

1. **Clone repository**

    ```bash
    git clone <repository-url>
    cd app_calculate
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database setup**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5. **Run development server**
    ```bash
    php artisan serve
    ```

## Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test tests/Unit/CategoryServiceTest.php

# Run with coverage
php artisan test --coverage
```

### Test Coverage

-   ✅ CRUD operations
-   ✅ Validation errors
-   ✅ Database transactions
-   ✅ Error handling
-   ✅ Edge cases

## Usage Examples

### 1. Create Category via AJAX

```javascript
const formData = {
    name: "Electronics",
    description: "Electronic products and gadgets",
    status: true,
};

fetch("/categories", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
    },
    body: JSON.stringify(formData),
})
    .then((response) => response.json())
    .then((result) => {
        if (result.success) {
            console.log("Category created:", result.data);
        } else {
            console.error("Error:", result.message);
        }
    });
```

### 2. Update Category via AJAX

```javascript
const formData = {
    name: "Updated Electronics",
    description: "Updated description",
    status: false,
};

fetch("/categories/1", {
    method: "PUT",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
    },
    body: JSON.stringify(formData),
})
    .then((response) => response.json())
    .then((result) => {
        if (result.success) {
            console.log("Category updated:", result.data);
        } else {
            console.error("Error:", result.message);
        }
    });
```

### 3. Delete Category via AJAX

```javascript
fetch("/categories/1", {
    method: "DELETE",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
    },
})
    .then((response) => response.json())
    .then((result) => {
        if (result.success) {
            console.log("Category deleted");
        } else {
            console.error("Error:", result.message);
        }
    });
```

## Error Handling

### Database Transaction

```php
DB::beginTransaction();
try {
    // Database operations
    DB::commit();
} catch (Exception $e) {
    DB::rollBack();
    throw $e;
}
```

### Validation Errors

```php
try {
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
        'description' => 'nullable|string',
        'status' => 'boolean'
    ]);
} catch (ValidationException $e) {
    return [
        'success' => false,
        'message' => 'Validation failed',
        'errors' => $e->errors()
    ];
}
```

### Logging

```php
Log::error('Category operation error: ' . $e->getMessage(), [
    'request_data' => $request->all(),
    'trace' => $e->getTraceAsString()
]);
```

## Security Features

-   ✅ **CSRF Protection**: Semua form dan AJAX request menggunakan CSRF token
-   ✅ **Input Validation**: Validasi input yang ketat
-   ✅ **SQL Injection Protection**: Menggunakan Eloquent ORM
-   ✅ **XSS Protection**: Output escaping dengan Blade
-   ✅ **Authentication**: Middleware auth untuk semua route

## Performance Features

-   ✅ **Database Indexing**: Index pada kolom yang sering dicari
-   ✅ **Pagination**: Mencegah loading data yang terlalu banyak
-   ✅ **Eager Loading**: Mengoptimalkan query database
-   ✅ **Caching**: Support untuk caching (bisa diimplementasikan)

## Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## License

This project is licensed under the MIT License.

## Support

Untuk pertanyaan atau dukungan, silakan buat issue di repository ini.
