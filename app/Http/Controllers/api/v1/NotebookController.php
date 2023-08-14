<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NotebookService;


class NotebookController extends Controller
{
    protected $NotebookService;


    public function __construct()
    {

        $this->NotebookService = app(NotebookService::class);
    }


    public function index()
    {
        $project = $this->NotebookService->AllNotebooks();
    }

    public function show($id)
    {
        $project = $this->NotebookService->GetNotebook($id);
    }


    public function store(Request $request)
    {

        $this->NotebookService->CreateNotebook($request);
    }


    public function update($id, Request $request)
    {

        $this->NotebookService->Update($request);
    }


    public function destroy($id)
    {

        //$project = $this->NotebookService->GetNotebook($id);
        $this->NotebookService->Delete($id);
    }
}
