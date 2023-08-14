<?php

namespace App\Services;

use App\Http\Requests\NotebookStoreRequest;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Str;


class NotebookService
{


    public function all()
    {
        $result = Notebook::get();

        return $result;
    }


    public function get($id)
    {
        $result = Notebook::find($id);

        return $result;
    }

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



    public function update($request)
    {
        // $data = $request->all();
        // $result = $project->fill($data)->save();

        // return $result;
    }

    public function delete($id)
    {
        $item = $this->Get($id);

        $result = Notebook::destroy($id);
        Storage::disk('public')->delete($item->image);

        return $result;
    }
}
