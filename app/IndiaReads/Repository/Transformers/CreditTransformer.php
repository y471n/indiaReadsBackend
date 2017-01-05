<?php

namespace App\IndiaReads\Repository\Transformers;


class CreditTransformer extends Transformer {

    public function transform($credit) {
        return [
            'userID' => $credit['user_id'],
            'storeCredit' => $credit['store_credit'],
            'usedCredit' => $credit['used_credit']
        ];
    }

}
