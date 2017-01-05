<?php

namespace App\IndiaReads\Repository\Transformers;


class AllCatTransformer extends Transformer {

    /**
     * @param $book
     * @return array
     */
    public function transform($cats) {
        return [
            'catID1' => $cats['cat1_id'],
            'category' => $cats['category']
        ];
    }

}
