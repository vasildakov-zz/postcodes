<?php

namespace Application\Handler;

use Domain\Entity\Postcode;
use Domain\Repository\PostcodeRepository;

final class FindPostcodeHandler
{
    /**
     * @var PostcodeRepository
     */
    private $postcodes;

    /**
     * @param PostcodeRepository $postcodes
     */
    public function __construct(PostcodeRepository $postcodes)
    {
        $this->postcodes = $postcodes;
    }

    /**
     * @param FindPostcode $command
     */
    public function __invoke(FindPostcode $command)
    {
        $id = $command->getId();
    }
}
