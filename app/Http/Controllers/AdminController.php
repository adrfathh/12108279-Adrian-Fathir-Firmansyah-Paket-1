<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Books;
use App\Models\Borrow;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    // USERS

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function addUser()
    {
        return view ('admin.addUser');
    }

    public function userStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'address' => 'required',
            'role' => 'required'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users');
    }

    public function editUser($id)
    {
        $users = User::where('id', '=', $id)->first();
        return view('admin.editUser', compact('users'));
    }

    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email'=> 'required',
            'address' => 'required',
            'role' => 'required'
        ]);

        
        User::where('id', '=', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->route('users')->with('success', 'Akun berhasil diupdate!');
    }


    public function deleteUser($id){
        $users = User::find($id);
        $users -> delete();
        return redirect()->route('users');
    }

    // BOOKS

    public function index()
    {
        $books = Books::latest()->paginate(4);
        return view('admin.index', compact('books'));
    }

    public function addBook()
    {
        $categories = Categories::all();
        return view('admin.addBook', compact('categories'));
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

        return redirect()->route('admin')->with(['success' => 'Buku berhasil di tambahkan!']);
    }

    public function editBook($id)
    {
        // $books = Books::where('id', '=', $id)->first();
        // $nameCategory = Categories::where('id', '=', $id)->first();
        // $books = Books::all();
        // $nameCategory = Categories::all();
        $books = Books::findOrFail($id);
        $categories = Categories::all();
        return view('admin.editBook', compact('books', 'categories'));
    }

    // public function bookUpdate(Request $request, $id)
    // {
    //     $request->validate([
    //         'author' => 'required',
    //         'title' => 'required',
    //         'publisher' => 'required',
    //         'year_publish' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,svg',
    //         'category' => 'required'
    //     ]);
        
    //     Books::where('id', '=', $id)->update([
    //         'author'     => $request->author,
    //         'title'   => $request->title,
    //         'content'   => $request->content,
    //         'publisher'   => $request->publisher,
    //         'year_publish'   => $request->year_publish,
    //         'image'     => $image->hashName(),
    //         'category'   => $request->category,
    //     ]);

    //     return redirect()->route('admin');
    // }

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
    
        return redirect()->route('admin');
    }

    public function deleteBook($id){
        $books = Books::find($id);
        $books -> delete();
        return redirect()->route('admin');
    }

    public function exportBooksAdmin()
    {
        $books = Books::all()->toArray();
        view()->share('books',$books);
        $pdf = PDF::loadView('pdf_view', $books);
        return $pdf->download('pdf_file.pdf');
    }

    // CATEGORIES

    public function categories()
    {
        $categories = Categories::orderby('created_at', 'DESC')->get();
        return view('admin.categories', compact('categories'));
    }

    public function categoriesStore(Request $request, Categories $categories)
    {
        $validateData = $request->validate([
            'name_categories' => 'required',
        ]);

        Categories::create([
            'name_categories' => $request->name_categories,
        ]);

        return redirect()->route('categories');
    }

    public function editCategory($id)
    {
        $categories = Categories::where('id', '=', $id)->first();
        return view('admin.editCategories', compact('categories'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name_categories' => 'required'
        ]);
        
        Categories::where('id', '=', $id)->update([
            'name_categories' => $request->name_categories
        ]);

        return redirect()->route('categories');
    }

    public function deleteCategory($id){
        $categories = Categories::find($id);
        $categories -> delete();
        return redirect()->route('categories');
    }

    // HISTORY

    public function history()
    {
        $borrow = Borrow::latest()->paginate(10);
        return view('admin.history', compact('borrow'));
    }
}
