<?php

namespace App\Http\Controllers;

use App\Services\Interface\WishlistServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    protected $wishlistService, $title, $base_url;

    public function __construct(WishlistServiceInterface $wishlistService)
    {
        $this->wishlistService = $wishlistService;
        $this->title = 'Wishlist';
        $this->base_url = url('wishlist/wishlists');
    }

    /**
     * Display a listing of wishlists
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $data['collection'] = $this->wishlistService->getAllWishlists($request);
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        // return $data;
        return view('wishlists.index', $data);
    }

    /**
     * Show the form for creating a new wishlist
     *
     * @return View
     */
    public function add()
    {
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('wishlists.add', $data);
    }

    /**
     * Store a newly created wishlist
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $result = $this->wishlistService->createWishlist($request);

        return response()->json($result);
    }

    /**
     * Display the specified wishlist
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->wishlistService->getWishlistById($id);

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified wishlist
     *
     * @param int $id
     */
    public function edit(int $id)
    {
        $data['item'] = $this->wishlistService->getWishlistById($id)['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;

        return view('wishlists.edit', $data);
    }

    /**
     * Update the specified wishlist
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $result = $this->wishlistService->updateWishlist($request, $request->id);

        return response()->json($result);
    }

    /**
     * Remove the specified wishlist
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $req): JsonResponse
    {
        $result = $this->wishlistService->deleteWishlist($req->id);

        return response()->json($result);
    }
}
