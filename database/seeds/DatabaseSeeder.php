<?php
use App\User;
use App\Book;
use App\BooksCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //$this->call(UsersTableSeeder::class);
        User::truncate();
        Book::truncate();
        BooksCategory::truncate();

        factory(User::class,3)->create();
        factory(BooksCategory::class,10)->create();
        factory(Book::class,200)->create();
    }
}
