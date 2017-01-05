<?php

namespace App\IndiaReads\Repository\Transformers;


class CatLevel1Transformer extends Transformer {

    /**
     * @param $cats
     * @return array
     */
    public function transform($cats) {
        return [
            'categoryId' => $cats['cat1_id'],
            'category' => $cats['category'],
        ];
    }

}
