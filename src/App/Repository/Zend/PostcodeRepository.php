<?php

namespace App\Repository\Zend;

use App\Repository\PostcodeRepositoryInterface;

class PostcodeRepository implements PostcodeRepositoryInterface
{
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * lookup
     * @param  [type] $postcode [description]
     * @return [type]           [description]
     */
    public function lookup($postcode)
    {
        //$statement = $this->adapter->query('SELECT * FROM `postcode` WHERE `id` = ?', [5]);
        //$result = $statement->execute();
        //return $result;

        return [
            'postcode'  => 'TW8 8FB',
            'outcode'   => 'TW8',
            'incode'    => '8FB',
            'latitude'  => 51.483954952877600,
            'longitude' => -0.312577856018865,
        ];
    }
}
