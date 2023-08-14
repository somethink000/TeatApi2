<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookStoreRequest;
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
        $project = $this->notebookService->all();
    }

    public function show($id)
    {
        $project = $this->notebookService->get($id);
    }

    public function store(NotebookStoreRequest $request): NotebookResource
    {
        $notebook = $this->notebookService->create($request);

        return new NotebookResource($notebook);
    }

    public function update($id, Request $request)
    {
        $this->notebookService->update($request);
    }

    public function destroy($id)
    {

        //$project = $this->NotebookService->GetNotebook($id);
        $this->notebookService->delete($id);
    }
}
