<?php

namespace Domain\Repository;

interface PostcodeRepositoryInterface
{
    public function lookup(string $postcode);
}
