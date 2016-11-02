<?php
namespace App\Middleware\Logger;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
#use Zend\Stratigility\ErrorMiddlewareInterface;
use Psr\Log\LoggerInterface;
#use Psr\Log\AbstractLogger;

class Logger
{
    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $this->logger->addInfo('My logger is now ready');

        //var_dump($this->logger); exit();
        /* if ($error instanceof \Exception) {
            $this->logger->error($error->getMessage());
        }*/

        if ($next !== null) {
            return $next($request, $response);
        }

        return $response;
    }
}
