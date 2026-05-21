<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('book_details')->truncate();
        DB::table('books')->truncate();
        DB::table('authors')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        // Stage 1: Create master data (Authors and Categories)
        $authors = Author::factory(5)->create();
        $categories = Category::factory(5)->create();

        // Stage 2-4: Create books with related book details
        for ($i = 0; $i < 10; $i++) {
            $book = Book::factory()->create([
                'author_id' => $authors->random()->id,
                'category_id' => $categories->random()->id,
            ]);

            // Stage 4: Create book detail for this book
            BookDetail::factory()->create([
                'book_id' => $book->id,
            ]);
        }

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        if ($this->command) {
            $this->command->info('Database seeding completed successfully.');
        }
    }
}
