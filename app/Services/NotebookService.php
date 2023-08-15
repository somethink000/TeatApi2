<?php

namespace App\Services;

use App\Http\Requests\NotebookStoreRequest;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Str;


class NotebookService
{


    public function create(NotebookStoreRequest $request): Notebook
    {
        $data = $request->only(
            'name',
            'company',
            'phone',
            'email',
            'birthday',
        );

        $path = $request->file('image')->store('notebook_images');
        $data['image'] = $path;

        return Notebook::create($data);
    }



    public function update(NotebookStoreRequest $request, Notebook $notebook): Notebook
    {

        $data = $request->only(
            'name',
            'company',
            'phone',
            'email',
            'birthday',
        );

        
        Storage::disk('public')->delete($notebook->image);

        $path = $request->file('image')->store('notebook_images');
        $data['image'] = $path;

        $notebook->updateOrFail($data);

        return $notebook;
    }

    public function destroy(Notebook $notebook): ?bool
    {
        return DB::transaction(function () use ($notebook): ?bool {
            $result = $notebook->delete();
            Storage::disk('public')->delete($notebook->image);
            return $result;
        });
    }
}
