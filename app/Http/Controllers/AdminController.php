<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){
        return view ('admin.index');
    }

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

        return redirect()->route('users')->with('success', 'Berhasil menambahkan user!');
    }

    public function editUser($id)
    {
        $users = User::where('id', '=', $id);
        return view('admin.editUser', compact('users'));
    }

    public function userUpdate(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email'=> 'required|unique:users',
            'address' => 'required',
            'role' => 'required'
        ]);

        $users['name'] = $request->name;
        $users['username'] = $request->username;
        $users['password'] = Hash::make($request->password);
        $users['email'] = $request->email;
        $users['address'] = $request->address;
        $users['role'] = $request->role;

        User::where('id', $id)->update($users);
        return redirect()->route('users');
    }

    public function addBook()
    {
        $categories = Categories::all();
        return view('admin.addBook', compact('categories'));
    }

    public function bookStore(Request $request, Books $books)
    {
        $validateData = $request->validate([
            'author' => 'required',
            'title' => 'required',
            'publisher' => 'required',
            'year_publish' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'category' => 'required'
        ]);

        $filename = time() . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('book', $filename, 'public');
        $validateData["image"] = '/storage/'.$path;

        $books = new Books();
        $books -> author = $request->author;
        $books -> title = $request->title;
        $books -> publisher = $request->publisher;
        $books -> year_publish = $request->year_publish;
        $books -> image = $validateData["image"];
        $books -> category = $request->category;
        $books -> book_status = 'Tersedia';

        return redirect()->route('admin');
    }

    public function categories()
    {
        $categories = Categories::latest()->paginate(10);
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
}
