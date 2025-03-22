<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $title = 'About Us';
        $description = 'About Us Setting';
        $aboutUs = AboutUs::find(1);

        return view('admin.about-us.edit', compact('title', 'aboutUs', 'description'));
    }

    public function update(Request $request)
    {
        $aboutUs = AboutUs::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');

            return redirect()->back();
        }

        $imageFields = ['image'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $aboutUs->{$field}) {
                $pathToOldFile = storage_path('app/public/images/'.$aboutUs->{$field});

                if (File::exists($pathToOldFile)) {
                    $newFileName = $this->moveAndRenameFile($pathToOldFile);
                    $aboutUs->{$field} = $newFileName;
                }
            }
        }

        $aboutUs->fill($request->all());

        foreach ($imageFields as $field) {
            if ($request->file($field)) {
                $filename = $this->saveFileToStorage($request->file($field), $field);
                $aboutUs->{$field} = $filename;
            }
        }
        $aboutUs->save();

        Alert::toast('About Us Berhasil Di ubah', 'success');

        return redirect()->back()->with('status', 'About Us Berhasil Diubah');
    }

    private function moveAndRenameFile($pathToOldFile)
    {
        $fileName = pathinfo($pathToOldFile, PATHINFO_FILENAME);
        $fileExtension = pathinfo($pathToOldFile, PATHINFO_EXTENSION);
        $newFileName = $fileName.'_'.time().'.'.$fileExtension;

        Storage::put('public/images/'.$newFileName, File::get($pathToOldFile));
        File::delete($pathToOldFile);

        return $newFileName;
    }

    private function saveFileToStorage($file, $field)
    {
        $filename = time().$field.'.'.$file->getClientOriginalExtension();
        $file->move(storage_path('app/public/images'), $filename);

        return $filename;
    }
}
