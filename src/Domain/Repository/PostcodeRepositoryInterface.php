<?php

namespace Domain\Repository;

interface PostcodeRepositoryInterface
{
    /**
     * @param  string $postcode
     * @return array
     */
    public function findOneByPostcode(string $postcode);
}
