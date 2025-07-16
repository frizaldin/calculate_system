# Status Helper Implementation

## Overview

Implementasi helper untuk menangani status kategori dengan konsistensi antara backend (PHP) dan frontend (JavaScript).

## File Structure

```
app/Helpers/
├── StatusHelper.php      # Class helper untuk status
├── functions.php         # Global helper functions
└── README.md            # Dokumentasi helper

public/js/
└── status-helper.js     # JavaScript helper untuk frontend

tests/Unit/
└── StatusHelperTest.php # Unit tests untuk helper

resources/views/categories/
├── index.blade.php      # View dengan helper implementation
├── add.blade.php        # Form add dengan helper
└── edit.blade.php       # Form edit dengan helper
```

## Backend Implementation (PHP)

### StatusHelper Class

Class utama yang berisi method-method untuk menangani status kategori.

#### Methods

1. **getStatusText($status): string**

    - Konversi boolean ke teks
    - `true` → `'Aktif'`
    - `false` → `'Nonaktif'`
    - `null` → `'Tidak Diketahui'`

2. **getStatusBadge($status): string**

    - Konversi boolean ke badge HTML
    - `true` → `<span class="badge bg-success">Aktif</span>`
    - `false` → `<span class="badge bg-danger">Nonaktif</span>`

3. **getStatusIcon($status): string**

    - Konversi boolean ke icon
    - `true` → `<i class="fa-solid fa-check-circle text-success"></i>`
    - `false` → `<i class="fa-solid fa-times-circle text-danger"></i>`

4. **getStatusFromText(string $statusText): ?bool**

    - Konversi teks ke boolean
    - Support: `'aktif'`, `'active'`, `'1'`, `'true'`, `'yes'` → `true`
    - Support: `'nonaktif'`, `'inactive'`, `'0'`, `'false'`, `'no'` → `false`

5. **getStatusOptions(): array**

    - Opsi untuk dropdown filter
    - `['' => 'Semua Status', '1' => 'Aktif', '0' => 'Nonaktif']`

6. **getStatusRadioOptions(): array**
    - Opsi untuk radio button
    - `['1' => 'Aktif', '0' => 'Nonaktif']`

### Global Helper Functions

Fungsi-fungsi global yang bisa digunakan di seluruh aplikasi:

-   `status_text($status)` - Konversi ke teks
-   `status_badge($status)` - Konversi ke badge
-   `status_icon($status)` - Konversi ke icon
-   `status_from_text($statusText)` - Konversi dari teks
-   `status_options()` - Opsi dropdown
-   `status_radio_options()` - Opsi radio
-   `is_status_active($status)` - Cek aktif
-   `is_status_inactive($status)` - Cek nonaktif
-   `toggle_status($status)` - Toggle status

## Frontend Implementation (JavaScript)

### StatusHelper Class

Class JavaScript yang mirror dari PHP helper.

#### Methods

1. **getStatusText(status)**

    - Konversi boolean ke teks
    - Support null/undefined values

2. **getStatusBadge(status)**

    - Konversi boolean ke badge HTML
    - Konsisten dengan PHP helper

3. **getStatusIcon(status)**

    - Konversi boolean ke icon
    - Menggunakan FontAwesome icons

4. **getStatusFromText(statusText)**

    - Konversi teks ke boolean
    - Support multiple input formats

5. **convertFormStatus(status)**

    - Konversi form data ke boolean
    - Handle checkbox, radio, string values

6. **renderStatusDropdown(name, selectedValue, className)**

    - Render dropdown HTML
    - Support custom attributes

7. **renderStatusRadio(name, selectedValue, className)**
    - Render radio buttons HTML
    - Support custom attributes

### Global Helper Functions

Fungsi-fungsi global di window object:

-   `window.statusText(status)`
-   `window.statusBadge(status)`
-   `window.statusIcon(status)`
-   `window.statusFromText(statusText)`
-   `window.statusOptions()`
-   `window.statusRadioOptions()`
-   `window.isStatusActive(status)`
-   `window.isStatusInactive(status)`
-   `window.toggleStatus(status)`
-   `window.convertFormStatus(status)`

## Usage Examples

### Backend (PHP)

#### Di Blade Template

```blade
{{-- Menampilkan teks status --}}
<td>{{ status_text($category->status) }}</td>

{{-- Menampilkan badge status --}}
<td>{!! status_badge($category->status) !!}</td>

{{-- Menampilkan icon status --}}
<td>{!! status_icon($category->status) !!}</td>

{{-- Dropdown filter --}}
<select name="status">
    @foreach(status_options() as $value => $label)
        <option value="{{ $value }}" {{ request()->status == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>

{{-- Radio button --}}
@foreach(status_radio_options() as $value => $label)
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status"
               id="status{{ $label }}" value="{{ $value }}"
               {{ $value == '1' ? 'checked' : '' }}>
        <label class="form-check-label" for="status{{ $label }}">{{ $label }}</label>
    </div>
@endforeach
```

#### Di Controller

```php
use App\Helpers\StatusHelper;

public function index()
{
    $categories = Category::all();

    // Filter berdasarkan status
    $activeCategories = $categories->filter(function($category) {
        return is_status_active($category->status);
    });

    return view('categories.index', compact('categories'));
}
```

#### Di Service

```php
public function updateCategoryStatus($id, $statusText)
{
    $status = status_from_text($statusText);

    if ($status === null) {
        throw new InvalidArgumentException('Status tidak valid');
    }

    $category = Category::find($id);
    $category->status = $status;
    $category->save();

    return [
        'success' => true,
        'message' => 'Status berhasil diubah menjadi ' . status_text($status)
    ];
}
```

### Frontend (JavaScript)

#### Di JavaScript File

```javascript
// Menggunakan helper functions
const statusText = window.statusText(true); // "Aktif"
const statusBadge = window.statusBadge(false); // HTML badge

// Konversi form data
const formData = new FormData(form);
const status = window.convertFormStatus(formData.get("status"));

// Render dropdown
const dropdownHtml = StatusHelper.renderStatusDropdown(
    "status",
    "1",
    "form-control"
);

// Render radio buttons
const radioHtml = StatusHelper.renderStatusRadio(
    "status",
    "1",
    "form-check-input"
);
```

#### Di AJAX Response

```javascript
// Display categories dengan helper
displayCategories(categories) {
    categories.data.forEach(category => {
        const statusBadge = window.statusBadge ?
            window.statusBadge(category.status) :
            `<span class="badge ${category.status ? 'bg-success' : 'bg-danger'}">${category.status ? 'Aktif' : 'Nonaktif'}</span>`;

        row.innerHTML = `
            <td>${category.name}</td>
            <td>${statusBadge}</td>
        `;
    });
}
```

## Installation & Setup

### 1. Backend Setup

1. **Autoload Helper Functions**

    File `app/Helpers/functions.php` sudah terdaftar di `composer.json`:

    ```json
    "autoload": {
        "files": [
            "app/Helpers/functions.php"
        ]
    }
    ```

2. **Dump Autoload**

    ```bash
    composer dump-autoload
    ```

3. **Clear Cache (Optional)**

    ```bash
    php artisan config:clear
    php artisan cache:clear
    ```

### 2. Frontend Setup

1. **Include JavaScript Helper**

    ```html
    <script src="{{ asset('js/status-helper.js') }}"></script>
    ```

2. **Use in Views**

    ```blade
    <x-slot name="js">
        <script src="{{ asset('js/status-helper.js') }}"></script>
        <script src="{{ asset('js/category.js') }}"></script>
    </x-slot>
    ```

## Testing

### Unit Tests

```bash
# Run specific test
php vendor/bin/phpunit tests/Unit/StatusHelperTest.php

# Run all tests
php artisan test
```

### Test Coverage

-   ✅ StatusHelper class methods
-   ✅ Global helper functions
-   ✅ Input validation
-   ✅ Output formatting
-   ✅ Edge cases (null, undefined)

## CSS Classes

### Badge Classes

-   Aktif: `bg-success`
-   Nonaktif: `bg-danger`
-   Tidak Diketahui: `bg-secondary`

### Icon Classes

-   Aktif: `fa-check-circle text-success`
-   Nonaktif: `fa-times-circle text-danger`
-   Tidak Diketahui: `fa-question-circle text-secondary`

## Supported Values

### Input Values (Boolean)

-   `true` - Status aktif
-   `false` - Status nonaktif
-   `null` - Status tidak diketahui

### Text Input Values

-   `'aktif'`, `'active'`, `'1'`, `'true'`, `'yes'` → `true`
-   `'nonaktif'`, `'inactive'`, `'0'`, `'false'`, `'no'` → `false`
-   Lainnya → `null`

### Output Values

-   `true` → `'Aktif'`
-   `false` → `'Nonaktif'`
-   `null` → `'Tidak Diketahui'`

## Benefits

### ✅ Consistency

-   Konsisten antara backend dan frontend
-   Format output yang seragam
-   Handling edge cases yang sama

### ✅ Reusability

-   Helper functions bisa digunakan di seluruh aplikasi
-   Tidak perlu duplikasi kode
-   Mudah maintenance

### ✅ Flexibility

-   Support multiple input formats
-   Customizable output formats
-   Extensible untuk kebutuhan baru

### ✅ Testing

-   Unit tests yang komprehensif
-   Coverage untuk semua edge cases
-   Easy to debug

### ✅ Performance

-   Lightweight implementation
-   No external dependencies
-   Efficient string operations

## Future Enhancements

### Possible Extensions

1. **Multi-language Support**

    ```php
    status_text($status, 'en'); // "Active"
    status_text($status, 'id'); // "Aktif"
    ```

2. **Custom Themes**

    ```php
    status_badge($status, 'bootstrap'); // Bootstrap classes
    status_badge($status, 'tailwind'); // Tailwind classes
    ```

3. **Status History**

    ```php
    status_history($category); // Track status changes
    ```

4. **Status Validation**
    ```php
    validate_status($input); // Validate status input
    ```

## Conclusion

StatusHelper menyediakan solusi yang komprehensif untuk menangani status kategori dengan konsistensi antara backend dan frontend. Implementasi ini memudahkan development dan maintenance dengan menyediakan helper functions yang reusable dan well-tested.
