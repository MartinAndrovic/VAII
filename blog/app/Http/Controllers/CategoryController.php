<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('isAdmin');
    }
    public function index() {
        $kategorie = Category::all();
        return view('categories.index', compact('kategorie'));
    }
    public function create() {
        return view('categories.create');
    }
    public function store() {
        Category::create(request()->validate([
            "nazov" => "required|string|min:3"
        ]));
        return redirect('/kategorie');
    }
    public function edit(Category $category) {

        return view('categories.edit', compact('category'));
    }
    public function update(Category $category) {
        $category->update(request()->validate([
            "nazov" => "required|string|min:3"
        ]));
        return redirect('/kategorie');
    }
}
