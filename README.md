Drupal 8 CORS

Thanks to the issue (#2303673)[https://github.com/drupal/drupal/commit/5ef912e9659131fd31d1522e3216d37323a0c047] in Drupal 8 now we have a new powerfull component, (StackPHP)[http://stackphp.com] is a middleware for the HttpKernel class, this middleware provide a decorator thas can intercept the request after to touch the Drupal Core.

## How to use
This modulo don't provide UI, only need you turn on.

## Installation
```bash
$ cd modules/
$ git clone git@github.com:dmouse/cors-drupal8.git cors
$ drush en cors
```

Middleware enabling cross-origin resource sharing for your http-{foundation,kernel} using application.

Cross-origin resource sharing (CORS) is a mechanism that allows a web page to make XMLHttpRequests to another domain. Such "cross-domain" requests would otherwise be forbidden by web browsers, per the same origin security policy.
