<?php

namespace App\IndiaReads\Repository\Transformers;


class NewsFeedTransformer extends Transformer {

    /**
     *
     * @param $book
     * @return array
     */
    public function transform($news_feed) {
        return [
            'productPageLink' => $news_feed['product_page_link'],
            'title' => $news_feed['book_title'],
            'description' => $news_feed['description']
        ];
    }

}
