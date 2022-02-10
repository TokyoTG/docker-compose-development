<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

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

        Discount::create([
            'price' => 16,
            'book_id' => Book::first()->id,
            'start_date' =>  '2022-02-10 00:00:00',
            'end_date' =>  '2022-02-14 00:00:00',
        ]);

        Discount::create([
            'price' => 16,
            'book_id' => Book::first()->id,
            'start_date' =>  '2022-02-07 00:00:00',
            'end_date' =>  '2022-02-09 00:00:00',
        ]);

        $book->authors()->syncWithoutDetaching(Author::pluck('id')->get()->toArray());

    }
}
