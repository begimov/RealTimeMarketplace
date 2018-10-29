<?php

namespace App\Http\Controllers\Webapi\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function store(Request $request)
    {
        Image::create([
            'name' => pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME)
        ]);
        
        $this->storeFileOnDisk('public', 'files', $request->file);
    }

    protected function storeFileOnDisk($disk, $path, $file)
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $extension = $file->getClientOriginalExtension();

        Storage::disk($disk)->putFileAs($path, $file, $name . '.' . $extension);
    }
}
