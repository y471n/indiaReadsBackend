<?php

namespace App\IndiaReads\Repository\Transformers;


class SubCatTransformer extends Transformer {

    /**
     * @param $book
     * @return array
     */
    public function transform($cats) {
        return [
            'catID2' => $cats['cat2_id'],
            'category' => $cats['category'],
        ];
    }

}
