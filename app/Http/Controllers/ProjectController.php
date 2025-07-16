<?php

namespace App\Http\Controllers;

use App\Services\ProjectServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService, $title, $base_url;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
        $this->title = 'Kategori';
        $this->base_url = url('tasklist/projects');
    }

    /**
     * Display a listing of categories
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $data['collection'] = $this->projectService->getAllProjects($request);
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        // return $data;
        return view('projects.index', $data);
    }

    /**
     * Show the form for creating a new Project
     *
     * @return View
     */
    public function add()
    {

        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('projects.add', $data);
    }

    /**
     * Store a newly created Project
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $result = $this->projectService->createProject($request);

        return response()->json($result);
    }

    /**
     * Display the specified Project
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->projectService->getProjectById($id);

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified Project
     *
     * @param int $id
     */
    public function edit(int $id)
    {
        $data['item'] = $this->projectService->getProjectById($id)['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;

        return view('projects.edit', $data);
    }

    /**
     * Update the specified Project
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $result = $this->projectService->updateProject($request, $request->id);

        return response()->json($result);
    }

    /**
     * Remove the specified Project
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $req): JsonResponse
    {
        $result = $this->projectService->deleteProject($req->id);

        return response()->json($result);
    }
}
