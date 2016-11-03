<?php

namespace App\Repository;

interface PostcodeRepositoryInterface
{
    public function lookup($postcode);
}
