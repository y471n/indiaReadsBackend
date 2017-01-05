<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 06/08/15
 * Time: 2:07 PM
 */

namespace App\IndiaReads\Repository\Transformers;


class UserTransformer extends Transformer {


    /**
     * @param $user
     * @return mixed
     */
    public function transform($user)
    {
        return [
            'email' => $user['user_email'],
            'status' => $user['status'],
            'role' => $user['user_role']
        ];
    }
}
