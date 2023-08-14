<?php

namespace App\Services;

use App\Models\Notebook;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Str;


class ProjectService
{


    public function All()
    {
        $result = Notebook::get();

        return $result;
    }


    public function Get($id)
    {
        $result = Notebook::find($id);

        return $result;
    }

    public function Create($request)
    {
        // $review = new Notebook();
        // $review->save();

        // $img = $request->file('image');
        // $path = $img->store('notebook_images');

        // $review->image = $path;


    }



    public function Update($request, $project)
    {
        // $data = $request->all();
        // $result = $project->fill($data)->save();

        // return $result;
    }

    public function Delete($id)
    {
        $item = $this->Get($id);

        $result = Notebook::destroy($id);
        Storage::disk('public')->delete($item->image);

        return $result;
    }
}
