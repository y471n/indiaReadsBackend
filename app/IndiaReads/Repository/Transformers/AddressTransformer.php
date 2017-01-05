<?php

namespace App\IndiaReads\Repository\Transformers;


class AddressTransformer extends Transformer {

    /**
     * @param $book
     * @return array
     */
    public function transform($address) {
        return [
            'addressBookID' => $address['address_book_id'],
            'userID' => $address['user_id'],
            'fullName' => $address['fullname'],
            'addressLine1' => $address['address_line1'],
            'addressLine2' => $address['address_line2'],
            'city' => $address['city'],
            'state' => $address['state'],
            'pincode' => $address['pincode'],
            'phone' => $address['phone']
        ];
    }

}
