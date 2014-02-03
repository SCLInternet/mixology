<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 15:32
 */

namespace Play\UseCase;


class ListIngredientsRequest implements RequestInterface {

    static public function fromArray(array $params)
    {
        return new self();
    }
}