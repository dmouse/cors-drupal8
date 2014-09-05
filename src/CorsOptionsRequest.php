<?php

/**
 * @file
 * Contains Drupal\cors\CorsOptionsRequest.
 */

namespace Drupal\cors;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use \Symfony\Component\HttpKernel\Event\GetResponseEvent;
use \Symfony\Component\HttpFoundation\Response;

class CorsOptionsRequest implements EventSubscriberInterface {

  static public function getSubscribedEvents() {
    return [
      'kernel.request' => 'onKernerRequest',
    ];
  }

  public function onKernerRequest(GetResponseEvent $event){
    $request = $event->getRequest();

    if ($request->getMethod() == 'OPTIONS') {
      $response = new Response();
      $response->setStatusCode(200);
      $response->headers->set('Access-Control-Allow-Credentials', 'true');
      $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, DELETE, OPTIONS');
      $event->setResponse($response);
      return ;
    }
  }
}
