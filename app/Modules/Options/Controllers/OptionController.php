<?php

namespace App\Modules\Options\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Options\Models\Option;
use App\Modules\Options\Requests\StoreOptionRequest;
use App\Modules\Options\Requests\UpdateOptionRequest;
use App\Modules\Options\Resources\OptionResource;
use App\Modules\Options\Services\OptionService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class OptionController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly OptionService $optionService)
    {
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Option::class);

        return $this->successResponse(OptionResource::collection($this->optionService->getAll()));
    }

    public function store(StoreOptionRequest $request): JsonResponse
    {
        $this->authorize('create', Option::class);

        $option = $this->optionService->create($request->validated());

        return $this->createdResponse(new OptionResource($option), 'Option created successfully');
    }

    public function show(int $id): JsonResponse
    {
        $option = $this->optionService->findOrFail($id);

        $this->authorize('view', Option::class);

        return $this->successResponse(new OptionResource($option));
    }

    public function update(UpdateOptionRequest $request, int $id): JsonResponse
    {
        $option = $this->optionService->findOrFail($id);

        $this->authorize('update', Option::class);

        $updated = $this->optionService->update($option, $request->validated());

        return $this->successResponse(new OptionResource($updated), 'Option updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $option = $this->optionService->findOrFail($id);

        $this->authorize('delete', Option::class);

        $this->optionService->delete($option);

        return $this->successResponse(null, 'Option deleted successfully');
    }
}
