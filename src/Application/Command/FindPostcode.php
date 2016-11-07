<?php

namespace Application\Command;

final class FindPostcode
{
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return PostcodeId::fromString($this->id);
    }
}
