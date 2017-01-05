<?php

namespace App\IndiaReads\Repository\Transformers;


class UserProfileTransformer extends Transformer {

    public function transform($profile) {
        return [
            'userID' => $profile['user_id'],
            'firstName' => $profile['first_name'],
            'lastName' => $profile['last_name'],
            'alternateEmail' => $profile['alternate_email'],
            'birthdate' => $profile['birthdate'],
            'landline' => $profile['landline'],
            'mobile' => $profile['mobile'],
            'profilePic' => $profile['profile_pic'],
            'gender' => $profile['gender']
        ];
    }

}
