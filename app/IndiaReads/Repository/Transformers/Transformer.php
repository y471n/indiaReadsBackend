<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 24/07/15
 * Time: 6:00 PM
 */

namespace App\IndiaReads\Repository\Transformers;

/**
 * Class Transformer
 * @package App\IndiaReads\Transformers
 */
abstract class Transformer {

    /**
     * Transform a book collection
     *
     * @param $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);

}
