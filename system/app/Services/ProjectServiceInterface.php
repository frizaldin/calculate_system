<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ProjectServiceInterface
{
    /**
     * Get all Projects with pagination
     *
     * @param Request $request
     */
    public function getAllProjects(Request $request);

    /**
     * Get Project by ID
     *
     * @param int $id
     * @return array
     */
    public function getProjectById(int $id): array;

    /**
     * Create new Project
     *
     * @param Request $request
     * @return array
     */
    public function createProject(Request $request): array;

    /**
     * Update Project
     *
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateProject(Request $request, int $id): array;

    /**
     * Delete Project
     *
     * @param int $id
     * @return array
     */
    public function deleteProject(int $id): array;
}
