<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    public $table = 'books';

    /**
     * @param $categoryId
     * @param $userId
     * @return void
     */
    public static function getBookList($categoryId, $userId)
    {
        DB::table('books')->select(['id']);
    }
}
