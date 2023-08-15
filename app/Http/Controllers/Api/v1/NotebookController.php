<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookStoreRequest;
use App\Http\Requests\NotebookUpdateRequest;
use App\Http\Resources\NotebookResource;
use App\Models\Notebook;
use App\Services\NotebookService;
use Illuminate\Http\Request;



class NotebookController extends Controller
{


    public function __construct(
        protected readonly NotebookService $notebookService
    ) {
    }

    public function index()
    {
        return NotebookResource::collection(Notebook::cursorPaginate(10));
    }

    public function show(Notebook $notebook): NotebookResource
    {
        return new NotebookResource($notebook);
    }

    public function store(NotebookStoreRequest $request): NotebookResource
    {
        $result = $this->notebookService->create($request);

        return new NotebookResource($result);
    }

    public function update(NotebookUpdateRequest $request, Notebook $notebook): NotebookResource
    {
        $this->notebookService->update($request, $notebook);
        return new NotebookResource($notebook);
    }

    public function destroy(Notebook $notebook): ?bool
    {
        return $this->notebookService->destroy($notebook);
    }
}
