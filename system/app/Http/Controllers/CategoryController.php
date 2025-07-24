<?php

namespace App\Http\Controllers;

use App\Services\Interface\CategoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $categoryService, $title, $base_url;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->title = 'Kategori';
        $this->base_url = url('wishlist/categories');
    }

    /**
     * Display a listing of categories
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $data['collection'] = $this->categoryService->getAllCategories($request);
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        // return $data;
        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new category
     *
     * @return View
     */
    public function add()
    {

        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('categories.add', $data);
    }

    /**
     * Store a newly created category
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $result = $this->categoryService->createCategory($request);

        return response()->json($result);
    }

    /**
     * Display the specified category
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->categoryService->getCategoryById($id);

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified category
     *
     * @param int $id
     */
    public function edit(int $id)
    {
        $data['item'] = $this->categoryService->getCategoryById($id)['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;

        return view('categories.edit', $data);
    }

    /**
     * Update the specified category
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $result = $this->categoryService->updateCategory($request, $request->id);

        return response()->json($result);
    }

    /**
     * Remove the specified category
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $req): JsonResponse
    {
        $result = $this->categoryService->deleteCategory($req->id);

        return response()->json($result);
    }
}
