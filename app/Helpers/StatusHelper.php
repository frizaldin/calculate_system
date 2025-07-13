<?php

namespace App\Helpers;

class StatusHelper
{
    /**
     * Konversi status boolean ke teks
     *
     * @param bool|null $status
     * @return string
     */
    public static function getStatusText($status): string
    {
        if ($status === null) {
            return 'Tidak Diketahui';
        }

        return $status ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Konversi status boolean ke badge HTML
     *
     * @param bool|null $status
     * @return string
     */
    public static function getStatusBadge($status): string
    {
        if ($status === null) {
            return '<span class="badge bg-secondary">Tidak Diketahui</span>';
        }

        $text = self::getStatusText($status);
        $class = $status ? 'bg-success' : 'bg-danger';

        return "<span class=\"badge {$class}\">{$text}</span>";
    }

    /**
     * Konversi status boolean ke icon
     *
     * @param bool|null $status
     * @return string
     */
    public static function getStatusIcon($status): string
    {
        if ($status === null) {
            return '<i class="fa-solid fa-question-circle text-secondary"></i>';
        }

        return $status
            ? '<i class="fa-solid fa-check-circle text-success"></i>'
            : '<i class="fa-solid fa-times-circle text-danger"></i>';
    }

    /**
     * Konversi teks status ke boolean
     *
     * @param string $statusText
     * @return bool|null
     */
    public static function getStatusFromText(string $statusText): ?bool
    {
        $statusText = strtolower(trim($statusText));

        switch ($statusText) {
            case 'aktif':
            case 'active':
            case '1':
            case 'true':
            case 'yes':
                return true;
            case 'nonaktif':
            case 'inactive':
            case '0':
            case 'false':
            case 'no':
                return false;
            default:
                return null;
        }
    }

    /**
     * Dapatkan semua opsi status untuk dropdown
     *
     * @return array
     */
    public static function getStatusOptions(): array
    {
        return [
            '' => 'Semua Status',
            '1' => 'Aktif',
            '0' => 'Nonaktif'
        ];
    }

    /**
     * Dapatkan opsi status untuk radio button
     *
     * @return array
     */
    public static function getStatusRadioOptions(): array
    {
        return [
            '1' => 'Aktif',
            '0' => 'Nonaktif'
        ];
    }

    /**
     * Cek apakah status aktif
     *
     * @param bool|null $status
     * @return bool
     */
    public static function isActive($status): bool
    {
        return $status === true;
    }

    /**
     * Cek apakah status nonaktif
     *
     * @param bool|null $status
     * @return bool
     */
    public static function isInactive($status): bool
    {
        return $status === false;
    }

    /**
     * Toggle status
     *
     * @param bool|null $status
     * @return bool
     */
    public static function toggleStatus($status): bool
    {
        return !$status;
    }
}
