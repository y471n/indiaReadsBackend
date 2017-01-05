<?php

namespace App\IndiaReads\Repository\Transformers;


class RentTransformer extends Transformer {

    /**
     *
     * @param $book
     * @return array
     */
    public function transform($rent) {
        return [
            'rent' => (array_key_exists('rent', $rent) ? $rent['rent'] : 0),
            'bookID' => $rent['book_id'],
            'mrp' => $rent['mrp'],
            'initialPayable' => $rent['initial_payable'],
            'availablityStatus' => $rent['availability_status'],
            'bookLibrary' => $rent['book_library'],
            'merchantLibrary' => $rent['merchant_library'],
            'procurementTime' => $rent['procurement_time']
        ];
    }

}
