<?php

namespace Domain\Repository;

interface PostcodeRepositoryInterface
{
    public function findOneByPostcode(string $postcode);
}
