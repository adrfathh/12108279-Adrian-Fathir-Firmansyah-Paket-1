<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrow;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    // BOOKS

    public function index()
    {
        $books = Books::latest()->paginate(4);
        return view('staff.index', compact('books'));
    }

    public function addBook()
    {
        $categories = Categories::all();
        return view('staff.addBook', compact('categories'));
    }

    public function bookStore(Request $request, Books $books)
    {
        $this->validate($request, [
            'author' => 'required',
            'title' => 'required',
            'publisher' => 'required',
            'year_publish' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'category' => 'required'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/book', $image->hashName());

        Books::create([
            'author'     => $request->author,
            'title'   => $request->title,
            'content'   => $request->content,
            'publisher'   => $request->publisher,
            'year_publish'   => $request->year_publish,
            'image'     => $image->hashName(),
            'category'   => $request->category,
            'books_status'   => 'Tersedia'
        ]);

        return redirect()->route('staff')->with(['success' => 'Buku berhasil di tambahkan!']);
    }

    public function editBook($id)
    {
        $books = Books::findOrFail($id);
        $categories = Categories::all();
        return view('staff.editBook', compact('books', 'categories'));
    }

    public function bookUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'title' => 'required',
            'author' => 'required',
            'publisher'=> 'required',
            'year_publish' => 'required',
            'category' => 'required',
        ]);
    
        if ($request->hasFile('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('buku', $filename, 'public');
            $validatedData["image"] = '/storage/' . $path;
            $books['image'] = $validatedData['image'];
        }
    
        $books['title'] = $request->title;
        $books['author'] = $request->author;
        $books['publisher'] = $request->publisher;
        $books['year_publish'] = $request->year_publish;
        $books['category'] = $request->category;
    
        Books::where('id', $id)->update($books);
    
        return redirect()->route('staff');
    }

    public function deleteBook($id){
        $books = Books::find($id);
        $books -> delete();
        return redirect()->route('staff');
    }

    // CATEGORIES

    public function categories()
    {
        $categories = Categories::latest()->paginate(10);
        return view('staff.categories', compact('categories'));
    }

    public function categoriesStore(Request $request, Categories $categories)
    {
        $validateData = $request->validate([
            'name_categories' => 'required',
        ]);

        Categories::create([
            'name_categories' => $request->name_categories,
        ]);

        return redirect()->route('categoriesStaff');
    }

    public function editCategory($id)
    {
        $categories = Categories::where('id', '=', $id)->first();
        return view('staff.editCategories', compact('categories'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name_categories' => 'required'
        ]);
        
        Categories::where('id', '=', $id)->update([
            'name_categories' => $request->name_categories
        ]);

        return redirect()->route('categoriesStaff');
    }

    public function deleteCategory($id){
        $categories = Categories::find($id);
        $categories -> delete();
        return redirect()->route('categoriesStaff');
    }

    // HISTORY

    public function history()
    {
        $borrow = Borrow::latest()->paginate(10);
        return view('staff.history', compact('borrow'));
    }
}
