<?php

namespace App\IndiaReads\Repository\Transformers;


class ProductTransformer extends Transformer {

    /**
     * @param $product details
     * @return array
     */
    public function transform($book) {
        return [
            'isbn13' => $book['ISBN13'],
            'title' => $book['title'],
            'author1' => $book['contributor_name1'],
            'author2' => $book['contributor_name2'],
            'author3' => $book['contributor_name3'],
            'shortDesc' => $book['short_desc'],
            'longDesc' => $book['long_desc'],
            'authorBio' => $book['author_bio'],
            'publisherName' => $book['publisher_name'],
            'imprintName' => $book['imprint_name'],
            'totalPages' => $book['page_no'],
            'publicationDate' => $book['publication_date'],
            'textLanguage' => $book['text_language'],
            'productForm' => $book['product_form']
        ];
    }

}
