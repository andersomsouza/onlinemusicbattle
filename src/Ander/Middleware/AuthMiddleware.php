<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 24/09/17
 * Time: 01:37
 */

namespace Ander\Middleware;
use Psr\Container\ContainerInterface;


class AuthMiddleware
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function __invoke($request, $response, $next)
    {
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            if($_SERVER['PHP_AUTH_USER'] == 'theway' && $_SERVER['PHP_AUTH_PW'] == 'theway123') {
                return $next($request,$response);
            }
        }
        return $response->withStatus(401)->withHeader('WWW-Authenticate', 'Basic realm="My Realm"')->write("<script>window.location.href = '{$this->container['router']->pathFor('index')}'</script>");;


    }
}