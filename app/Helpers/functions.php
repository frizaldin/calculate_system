<?php

use App\Helpers\StatusHelper;

if (!function_exists('status_text')) {
    /**
     * Konversi status boolean ke teks
     *
     * @param bool|null $status
     * @return string
     */
    function status_text($status): string
    {
        return StatusHelper::getStatusText($status);
    }
}

if (!function_exists('status_badge')) {
    /**
     * Konversi status boolean ke badge HTML
     *
     * @param bool|null $status
     * @return string
     */
    function status_badge($status): string
    {
        return StatusHelper::getStatusBadge($status);
    }
}

if (!function_exists('status_icon')) {
    /**
     * Konversi status boolean ke icon
     *
     * @param bool|null $status
     * @return string
     */
    function status_icon($status): string
    {
        return StatusHelper::getStatusIcon($status);
    }
}

if (!function_exists('status_from_text')) {
    /**
     * Konversi teks status ke boolean
     *
     * @param string $statusText
     * @return bool|null
     */
    function status_from_text(string $statusText): ?bool
    {
        return StatusHelper::getStatusFromText($statusText);
    }
}

if (!function_exists('status_options')) {
    /**
     * Dapatkan semua opsi status untuk dropdown
     *
     * @return array
     */
    function status_options(): array
    {
        return StatusHelper::getStatusOptions();
    }
}

if (!function_exists('status_radio_options')) {
    /**
     * Dapatkan opsi status untuk radio button
     *
     * @return array
     */
    function status_radio_options(): array
    {
        return StatusHelper::getStatusRadioOptions();
    }
}

if (!function_exists('is_status_active')) {
    /**
     * Cek apakah status aktif
     *
     * @param bool|null $status
     * @return bool
     */
    function is_status_active($status): bool
    {
        return StatusHelper::isActive($status);
    }
}

if (!function_exists('is_status_inactive')) {
    /**
     * Cek apakah status nonaktif
     *
     * @param bool|null $status
     * @return bool
     */
    function is_status_inactive($status): bool
    {
        return StatusHelper::isInactive($status);
    }
}

if (!function_exists('toggle_status')) {
    /**
     * Toggle status
     *
     * @param bool|null $status
     * @return bool
     */
    function toggle_status($status): bool
    {
        return StatusHelper::toggleStatus($status);
    }
}

if (!function_exists('type_options')) {
    /**
     * Dapatkan semua opsi type untuk dropdown
     *
     * @return array
     */
    function type_options(): array
    {
        return [
            '' => 'Semua Tipe',
            'Wishlist' => 'Wishlist'
        ];
    }
}

if (!function_exists('type_radio_options')) {
    /**
     * Dapatkan opsi type untuk radio button
     *
     * @return array
     */
    function type_radio_options(): array
    {
        return [
            'Wishlist' => 'Wishlist'
        ];
    }
}

if (!function_exists('type_text')) {
    /**
     * Konversi type ke teks yang lebih user-friendly
     *
     * @param string|null $type
     * @return string
     */
    function type_text($type): string
    {
        if ($type === null) {
            return 'Tidak Diketahui';
        }

        switch ($type) {
            case 'Wishlist':
                return 'Wishlist';
            default:
                return 'Tidak Diketahui';
        }
    }
}

if (!function_exists('type_badge')) {
    /**
     * Konversi type ke badge HTML
     *
     * @param string|null $type
     * @return string
     */
    function type_badge($type): string
    {
        if ($type === null) {
            return '<span class="badge bg-secondary">Tidak Diketahui</span>';
        }

        $text = type_text($type);
        $class = 'bg-primary'; // Default class untuk type

        switch ($type) {
            case 'Wishlist':
                $class = 'bg-info';
                break;
            default:
                $class = 'bg-secondary';
        }

        return "<span class=\"badge {$class}\">{$text}</span>";
    }
}

if (!function_exists('priceToInt')) {

    function priceToInt($price)
    {
        return str_replace(',', '', $price);
    }
}


if (!function_exists('badgeStatusWishlist')) {
    /**
     * Mengembalikan badge HTML untuk status wishlist.
     *
     * @param string|null $status
     * @return string
     */
    function badgeStatusWishlist($status)
    {
        if ($status === 'wishlist') {
            return '<span class="badge bg-warning text-dark">Wishlist</span>';
        } elseif ($status === 'purchased') {
            return '<span class="badge bg-success">Purchased</span>';
        } else {
            return '<span class="badge bg-secondary">Tidak Diketahui</span>';
        }
    }
}
