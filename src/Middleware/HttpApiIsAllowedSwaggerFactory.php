<?php

namespace Reliv\SwaggerExpressive\Middleware;

use Psr\Container\ContainerInterface;
use Reliv\SwaggerExpressive\Api\IsAllowedSwagger;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class HttpApiIsAllowedSwaggerFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return HttpApiIsAllowedSwagger
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        $appConfig = $serviceContainer->get('config');
        $debug = false;
        if (array_key_exists('debug', $appConfig)) {
            $debug = (bool)$appConfig['debug'];
        }

        return new HttpApiIsAllowedSwagger(
            $serviceContainer->get(IsAllowedSwagger::class),
            [],
            HttpApiIsAllowedSwagger::DEFAULT_NOT_ALLOWED_STATUS,
            $debug
        );
    }
}
