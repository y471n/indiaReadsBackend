<?php

namespace App\IndiaReads\Repository\Transformers;


class BookshelfTransformer extends Transformer {

    /**
     * @param $book
     * @return array
     */
    public function transform($book) {
        return [
            'itemID' => $book['item_id'],
            'userID' => $book['user_id'],
            'isbn13' => $book['ISBN13'],
            'title' => $book['title'],
            'author1' => $book['contributor_name1'],
            'initialPayable' => $book['init_pay'],
            'shelfType' => $book['shelf_type'],
            'when' => $book['when']
        ];
    }

}
