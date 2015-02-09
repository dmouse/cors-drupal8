<?php

/**
 * @file
 * Contains Drupal\cors\Form\AllowCors.
 */

namespace Drupal\cors\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;

class AllowCors extends ConfigFormBase
{

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var Drupal\Core\Config\ConfigFactory
   */
  protected $config_factory;


  public function __construct(
    ConfigFactoryInterface $config_factory,
    ConfigFactory $config_factory
  ) {
    parent::__construct($config_factory);
    $this->config_factory = $config_factory;
  }


  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('config.factory')
    );
  }



  /**
  * {@inheritdoc}
  */
  protected function getEditableConfigNames() {
    return [
      'cors.allow_cors_config'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'allow_cors';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('cors.allow_cors_config');
    $form['allowed_headers'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Allowed headers'),
      '#description' => $this->t('Allowed headers'),
      '#default_value' => $config->get('allowed_headers'),
    );
    $form['allowed_methods'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Allowed methods'),
      '#description' => $this->t('Allowed methods'),
      '#default_value' => $config->get('allowed_methods'),
    );
    $form['allowed_origins'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Allowed Origins'),
      '#description' => $this->t('Allowed origins'),
      '#default_value' => $config->get('allowed_origins'),
    );
    $form['exposed_headers'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Exposed headers'),
      '#description' => $this->t('Exposed headers'),
      '#default_value' => $config->get('exposed_headers'),
    );
    $form['max_age'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Max Age'),
      '#description' => $this->t('Max age.'),
      '#default_value' => $config->get('max_age'),
    );
    $form['support_credentials'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Support credentials'),
      '#description' => $this->t('Support credentials'),
      '#default_value' => $config->get('support_credentials'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('cors.allow_cors_config')
      ->set('allowed_headers', $form_state->getValue('allowed_headers'))
      ->set('allowed_methods', $form_state->getValue('allowed_methods'))
      ->set('allowed_origins', $form_state->getValue('allowed_origins'))
      ->set('exposed_headers', $form_state->getValue('exposed_headers'))
      ->set('max_age', $form_state->getValue('max_age'))
      ->set('support_credentials', $form_state->getValue('support_credentials'))
    ->save();
  }
}
