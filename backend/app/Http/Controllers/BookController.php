<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\DiscountPrices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{


    public function index(Request $request){

        $page = 1;
        $offset = 0;
        $per_page = 10;
        if($request->page && $request->page  > 1){
            $page =  $request->page;
            $offset = $page * $per_page;
        }

        $books = DB::table('books')->selectRaw(
             "books.*, discount_prices.price as discount, GROUP_CONCAT(authors.name) as authors
             "
        )->leftJoin('discount_prices', function ($join) {
            $join->on(  'discount_prices.book_id','=','books.id')
                 ->whereRaw(' (discount_prices.start_date >= CURDATE() AND discount_prices.end_date > CURDATE()) ');
        })
        
        ->leftJoin('author_book','author_book.book_id','=','books.id')
        ->leftJoin('authors','author_book.author_id','=','authors.id')
        ->groupBy('books.id')
        ->offset($offset)
        ->limit($per_page)
         ->get();
        return response()->json(['status' => 'success', 'data' => $books]);
    }
    public function seedDb(){
        $book = Book::create([
            'title' => 'Book title',
            'base_price' => 10.45,
            'cover_image' => 'cover image'
        ]);

        Author::create([
            'name' => 'First Author'
        ]);
        Author::create([
            'name' => 'Second Author'
        ]);

        DiscountPrices::create([
            'price' => 16,
            'book_id' => Book::first()->id,
            'start_date' =>  '2022-02-10 00:00:00',
            'end_date' =>  '2022-02-14 00:00:00',
        ]);

        DiscountPrices::create([
            'price' => 16,
            'book_id' => Book::first()->id,
            'start_date' =>  '2022-02-07 00:00:00',
            'end_date' =>  '2022-02-09 00:00:00',
        ]);

        $book->authors()->syncWithoutDetaching(Author::pluck('id')->toArray());
    }
}