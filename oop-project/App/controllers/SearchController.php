<?php

use Oop\Project\Book;

$q = $_GET['q'] ?? '';

$books = [];

if ($q !== '') {
    $books = Book::search($db, $q);
}

require "App/views/search.php";
