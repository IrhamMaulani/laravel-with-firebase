<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function getAllBooks()
    {
        return $this->get();
    }

    public function getById($id)
    {
        return $this->findOrFail($id);
    }

    public function delete($id)
    {
        $book = $this->getById($id);

        return $book->delete();
    }
}