<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:.png,.jpeg',
        ]);

        if ($request->file('image')) {
            $filePath = $request->file('image')->store('storage/fruits-img');
            $url = Storage::url($filePath);
            return back()->with('success', '画像をアップロードしました！')->with('image_url', $url);
        }

        return back()->with('error', '画像のアップロードに失敗しました。');
    }
}
