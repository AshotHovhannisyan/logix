<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|file|mimes:jpg,png,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            try {
                Storage::disk('public')->putFileAs('images', $image, $imageName);
            }catch (\Exception $e) {
                return redirect()->back()->with('error', 'File upload error: ' . $e->getMessage());
            }

            $data['image'] = $imageName;

        }

        Article::create($data);

        return redirect()->route('article');
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show', compact('article'));
    }
}
