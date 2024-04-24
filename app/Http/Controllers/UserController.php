<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use App\Models\Borrow;
use App\Models\Review;
use App\Models\Collection;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $books = Books::latest()->paginate(4);
        return view('user.index', compact('books'));
    }

    public function borrowed()
    {
        $borrow = Borrow::all();
        $books = Books::whereHas('borrow')->get();
        return view('user.borrowed', compact('books', 'borrow'));
    }

    public function borrow(Request $request)
    {
        $returnDate = now()->addDays(7);

        Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::user()->id,
            'borrow_status' => 'Dipinjam',
            'borrow_date' => now(),
            'return_date' => $returnDate,
        ]);

        return redirect()->route('user.books');
    }

    public function removeBorrow($id){
        $borrow = Borrow::where('book_id', $id)->get();
        foreach ($borrow as $borrow) {
            $borrow->delete();
        }
        return redirect()->route('user.borrowed');
    }

    function addWishlist(Request $request)
    {
        $userId = Auth::user()->id;
        $bookId = $request->book_id;
        $collection = Collection::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if ($collection) {
            return redirect()->route('user.books');
        }

        Collection::create([
            'user_id' => $userId,
            'book_id' => $bookId
        ]);

        return redirect()->route('user.books');
    }

    public function wishlist()
    {
        $collection = Collection::all();
        $books = Books::whereHas('collection')->get();
        return view('user.wishlist', compact('books', 'collection'));
    }

    public function removeWishlist($id){
        $collection = Collection::where('book_id', $id)->get();
        foreach ($collection as $collection) {
            $collection->delete();
        }
        return redirect()->route('user.wishlist');
    }

    public function review()
    {
        // Mengambil semua ulasan
        $review = Review::all();
        // $review = Review::where('book_id', $id)->get();
        // $review = Review::where('id')->get();

        // Mengambil daftar buku yang memiliki ulasan
        $books = Books::has('review')->get();

        // Mengambil daftar pengguna yang memiliki ulasan
        $users = User::has('review')->get();

        return view('user.review', compact('review', 'books', 'users'));
    }

    public function addReview($id)
    {
        $books = Books::where('id', '=', $id)->first();
        return view('user.addReview', compact('books'));
    }

    public function reviewStore(Request $request)
    {
        $validateData = $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        Review::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::user()->id,
            'review' => $request->review,
            'rating' => $request->rating
        ]);

        return redirect()->route('user.review');
    }

    public function editReview($id)
    {
        // Mengambil semua ulasan
        $review = Review::where('id', '=', $id)->first();

        // Mengambil daftar buku yang memiliki ulasan
        $books = Books::has('review')->get();

        // Mengambil daftar pengguna yang memiliki ulasan
        $users = User::has('review')->get();

        return view('user.editReview', compact('review', 'books', 'users'));
    }

    public function reviewUpdate(Request $request, $id)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);
        
        Review::where('id', '=', $id)->update([
            'review' => $request->review,
            'rating' => $request->rating
        ]);

        return redirect()->route('user.review');
    }

    public function removeReview($id){
        $review = Review::where('book_id', $id)->get();
        foreach ($review as $review) {
            $review->delete();
        }
        return redirect()->route('user.borrowed');
    }

    public function history(){
        return view ('user.history');
    }
}
