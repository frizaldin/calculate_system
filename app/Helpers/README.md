# Status Helper Documentation

Helper untuk menangani status kategori dengan berbagai format tampilan dan konversi.

## File Structure

```
app/Helpers/
├── StatusHelper.php      # Class helper untuk status
├── functions.php         # Global helper functions
└── README.md            # Dokumentasi ini
```

## StatusHelper Class

Class utama yang berisi method-method untuk menangani status kategori.

### Methods

#### `getStatusText($status): string`

Konversi status boolean ke teks.

```php
StatusHelper::getStatusText(true);   // "Aktif"
StatusHelper::getStatusText(false);  // "Nonaktif"
StatusHelper::getStatusText(null);   // "Tidak Diketahui"
```

#### `getStatusBadge($status): string`

Konversi status boolean ke badge HTML.

```php
StatusHelper::getStatusBadge(true);   // '<span class="badge bg-success">Aktif</span>'
StatusHelper::getStatusBadge(false);  // '<span class="badge bg-danger">Nonaktif</span>'
```

#### `getStatusIcon($status): string`

Konversi status boolean ke icon.

```php
StatusHelper::getStatusIcon(true);   // '<i class="fa-solid fa-check-circle text-success"></i>'
StatusHelper::getStatusIcon(false);  // '<i class="fa-solid fa-times-circle text-danger"></i>'
```

#### `getStatusFromText(string $statusText): ?bool`

Konversi teks status ke boolean.

```php
StatusHelper::getStatusFromText('aktif');     // true
StatusHelper::getStatusFromText('nonaktif');  // false
StatusHelper::getStatusFromText('unknown');   // null
```

#### `getStatusOptions(): array`

Dapatkan opsi status untuk dropdown.

```php
StatusHelper::getStatusOptions();
// Returns:
// [
//     '' => 'Semua Status',
//     '1' => 'Aktif',
//     '0' => 'Nonaktif'
// ]
```

#### `getStatusRadioOptions(): array`

Dapatkan opsi status untuk radio button.

```php
StatusHelper::getStatusRadioOptions();
// Returns:
// [
//     '1' => 'Aktif',
//     '0' => 'Nonaktif'
// ]
```

#### `isActive($status): bool`

Cek apakah status aktif.

```php
StatusHelper::isActive(true);   // true
StatusHelper::isActive(false);  // false
```

#### `isInactive($status): bool`

Cek apakah status nonaktif.

```php
StatusHelper::isInactive(true);   // false
StatusHelper::isInactive(false);  // true
```

#### `toggleStatus($status): bool`

Toggle status.

```php
StatusHelper::toggleStatus(true);   // false
StatusHelper::toggleStatus(false);  // true
```

## Global Helper Functions

Fungsi-fungsi global yang bisa digunakan di seluruh aplikasi.

### `status_text($status): string`

```php
status_text(true);   // "Aktif"
status_text(false);  // "Nonaktif"
```

### `status_badge($status): string`

```php
status_badge(true);   // '<span class="badge bg-success">Aktif</span>'
status_badge(false);  // '<span class="badge bg-danger">Nonaktif</span>'
```

### `status_icon($status): string`

```php
status_icon(true);   // '<i class="fa-solid fa-check-circle text-success"></i>'
status_icon(false);  // '<i class="fa-solid fa-times-circle text-danger"></i>'
```

### `status_from_text(string $statusText): ?bool`

```php
status_from_text('aktif');     // true
status_from_text('nonaktif');  // false
```

### `status_options(): array`

```php
status_options();
// Returns array untuk dropdown
```

### `status_radio_options(): array`

```php
status_radio_options();
// Returns array untuk radio button
```

### `is_status_active($status): bool`

```php
is_status_active(true);   // true
is_status_active(false);  // false
```

### `is_status_inactive($status): bool`

```php
is_status_inactive(true);   // false
is_status_inactive(false);  // true
```

### `toggle_status($status): bool`

```php
toggle_status(true);   // false
toggle_status(false);  // true
```

## Usage Examples

### Di Blade Template

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
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>

{{-- Radio button --}}
@foreach(status_radio_options() as $value => $label)
    <div class="form-check">
        <input type="radio" name="status" value="{{ $value }}">
        <label>{{ $label }}</label>
    </div>
@endforeach
```

### Di Controller

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

### Di Service

```php
use App\Helpers\StatusHelper;

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

## Installation

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

## Supported Status Values

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

## CSS Classes

### Badge Classes

-   Aktif: `bg-success`
-   Nonaktif: `bg-danger`
-   Tidak Diketahui: `bg-secondary`

### Icon Classes

-   Aktif: `fa-check-circle text-success`
-   Nonaktif: `fa-times-circle text-danger`
-   Tidak Diketahui: `fa-question-circle text-secondary`

## Testing

Helper functions bisa di-test dengan unit test:

```php
public function test_status_text()
{
    $this->assertEquals('Aktif', status_text(true));
    $this->assertEquals('Nonaktif', status_text(false));
    $this->assertEquals('Tidak Diketahui', status_text(null));
}

public function test_status_from_text()
{
    $this->assertTrue(status_from_text('aktif'));
    $this->assertFalse(status_from_text('nonaktif'));
    $this->assertNull(status_from_text('unknown'));
}
```
