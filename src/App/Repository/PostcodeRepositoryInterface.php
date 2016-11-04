<?php

namespace App\Repository;

interface PostcodeRepositoryInterface
{
    public function lookup(string $postcode);
}
