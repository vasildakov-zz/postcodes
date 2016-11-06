<?php
/**
 * https://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/
 * http://slashnode.com/pdo-for-elegant-php-database-access/
 */
namespace Infrastructure\Repository\Pdo;

use Domain\Repository\PostcodeRepositoryInterface;

final class PostcodeRepository implements PostcodeRepositoryInterface
{
    /**
     * @var PDO $connection
     */
    private $connection;

    /**
     * Constructor
     *
     * @param PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    /**
     * Find one by postcode
     *
     * @param  string   $postcode
     * @return array
     */
    public function findOneByPostcode(string $postcode)
    {
        $sql = "SELECT * FROM postcode WHERE postcode = :postcode LIMIT 1";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':postcode', $postcode, \PDO::PARAM_STR);
        $statement->execute();
        //$statement->setFetchMode(\PDO::FETCH_INTO, new \Domain\Entity\Postcode());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        return $statement->fetch();
    }
}
