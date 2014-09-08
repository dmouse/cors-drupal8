<?php

/**
 * @file 
 *   Contains Drupal\cors\StackOptionsRequest.
 */

namespace Drupal\cors;

use Drupal\Core\DrupalKernelInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    if ($request->getMethod() == 'OPTIONS') {
      $response = new Response(NULL);
      $response->setStatusCode(200);
      $response->headers->set('Access-Control-Allow-Origin', '*');
      $response->headers->set('Access-Control-Allow-Headers', 'Authorization');
      $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, DELETE, OPTIONS');
      
      $response->send();
      return ;
    }

    return $this->httpKernel->handle($request, $type, $catch);
  }

}
