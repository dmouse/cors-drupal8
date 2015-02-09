<?php

/**
 * @file 
 *   Contains Drupal\cors\StackOptionsRequest.
 */

namespace Drupal\cors;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Asm89\Stack\Cors;

/**
 * Wrapper to OPTIONS request.
 */
class StackOptionsRequest implements HttpKernelInterface {

  /**
   * The wrapped kernel implementation.
   *
   * @var \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  private $app;

  /**
   * Create a new StackOptionsRequest instance.
   *
   * @param  \Symfony\Component\HttpKernel\HttpKernelInterface  $app
   *   Hrrp Kernel.
   */
  public function __construct(HttpKernelInterface $app) {
    $this->app = $app;
  }

  /**
   * {@inheritDoc}
   */
  public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
    $cors = new Cors($this->app, [
      'allowedHeaders'      => ["*"],
      'allowedMethods'      => ['DELETE', 'GET', 'POST', 'PUT'],
      'allowedOrigins'      => ["*"],
      'exposedHeaders'      => false,
      'maxAge'              => false,
      'supportsCredentials' => false,
    ]);

    return $cors->handle($request, $type, $catch);
  }

}
