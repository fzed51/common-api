<?php
declare(strict_types=1);
/**
 * User: Fabien Sanchez
 * Date: 10/07/2019
 * Time: 14:23
 */

namespace CommonApi;

use Slim\Http\Response;

interface ResponseFormatterInterface
{

    /**
     * @param \Slim\Http\Response $response
     * @param null $data
     * @return \Slim\Http\Response
     */
    public function success(Response $response, $data = null): Response;

    /**
     * @param \Slim\Http\Response $response
     * @param int $code
     * @param null $data
     * @return \Slim\Http\Response
     */
    public function error(Response $response, int $code, $data = null): Response;

}