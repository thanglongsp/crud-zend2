<?php
namespace Book\Repository;
use Book\Model\Book;

interface IBookRepository {
    public function getAllBook();
    public function getBookById($id);
    public function addBook(Book $book);
    public function deleteBook($id);
    public function deleteBookByCategoryId($categoryId);
}