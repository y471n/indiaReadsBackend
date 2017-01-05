<?php

namespace App\IndiaReads\Repository\Transformers;


class ParentCategoryTransformer extends Transformer {

    /**
     * @param $cats
     * @return array
     */
    public function transform($cats) {
        return [
            'categoryId' => $cats['parent_id'],
            'category' => $cats['category'],
        ];
    }

}
