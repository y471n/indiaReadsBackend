<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 24/07/15
 * Time: 6:02 PM
 */

namespace App\IndiaReads\Repository\Transformers;


class BookTransformer extends Transformer {

    /**
     * @param $book
     * @return array
     */
    public function transform($book) {
        return [
            'isbn13' => $book['ISBN13'],
            'title' => $book['title'],
        ];
    }

}
