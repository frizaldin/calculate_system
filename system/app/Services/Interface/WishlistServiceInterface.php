<?php

namespace App\Services\Interface;

use Illuminate\Http\Request;

interface WishlistServiceInterface
{
    /**
     * Get all wishlists with pagination
     *
     * @param Request $request
     */
    public function getAllWishlists(Request $request);

    /**
     * Get wishlist by ID
     *
     * @param int $id
     * @return array
     */
    public function getWishlistById(int $id): array;

    /**
     * Create new wishlist
     *
     * @param Request $request
     * @return array
     */
    public function createWishlist(Request $request): array;

    /**
     * Update wishlist
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateWishlist(Request $request, int $id): array;

    /**
     * Delete wishlist
     *
     * @param int $id
     * @return array
     */
    public function deleteWishlist(int $id): array;
}
