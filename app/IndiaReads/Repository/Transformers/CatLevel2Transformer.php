<?php

namespace App\IndiaReads\Repository\Transformers;


class CatLevel2Transformer extends Transformer {

    /**
     * @param $cats
     * @return array
     */
    public function transform($cats) {
        return [
            'categoryId' => $cats['cat2_id'],
            'category' => $cats['category'],
        ];
    }

}
