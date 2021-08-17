<?php

namespace Drupal\guestbook\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\AjaxResponse;

/**
 * Adding AJAX stuff.
 */
class GuestForm extends ContentEntityForm {

  /**
   * Building the form and adding AJAX callbacks.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var  \Drupal\guestbook\Entity\Guestbook $entity */
    $form   = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $form['system-messages'] = [
      '#type'   => 'markup',
      '#markup' => '<div id="form-system-messages-name"></div>',
      '#weight' => '-100',
    ];

    $form['name']['widget'][0]['value']['#ajax'] = [
      'callback' => '::validateNameAjax',
      'event'    => 'change',
    ];

    $form['email']['widget'][0]['value']['#ajax'] = [
      'callback' => '::validateEmailAjax',
      'event'    => 'change',
    ];

    $form['tel']['widget'][0]['value']['#ajax'] = [
      'callback' => '::validateTelAjax',
      'event'    => 'change',
    ];

    $form['zal'] = [
      '#type'   => 'markup',
      '#prefix' => '<div class="buttons-wrapper-div">',
      '#weight' => '30',
    ];
    $form['upa'] = [
      '#type'   => 'markup',
      '#suffix' => '</div>',
      '#weight' => '50',
    ];

    return [
      $form,
    ];
  }

  /**
   * AJAX form fields validation.
   */

  /**
   * Name AJAX validation.
   */
  public function validateNameAjax(array $form, FormStateInterface $form_state) {
    $response  = new AjaxResponse();
    $nameValue = $form_state->getValue('name');
    if (!preg_match(
        '/^[A-Za-z]*$/', $nameValue[0]['value']) || strlen($nameValue[0]['value']) <= 2 ||
      strlen($nameValue[0]['value']) >= 100) {
      $response->addCommand(new HtmlCommand(
        '#form-system-messages-name',
        '<p class="ajax-form-message email-ajax-validation-alert-text">
                   Name isn`t correct.
                </p>'));
    }
    else {
      $response->addCommand(new HtmlCommand(
        '#form-system-messages-name',
        ''
      ));
    }
    return $response;
  }

  /**
   * Email AJAX validation.
   */
  public function validateEmailAjax(array $form, FormStateInterface $form_state) {
    $response   = new AjaxResponse();
    $emailValue = $form_state->getValue('email');
    if (!filter_var($emailValue[0]['value'], FILTER_VALIDATE_EMAIL)
      || !preg_match('/^[A-Za-z1-9-_]+[@]+[a-z]+[.]+[a-z]+$/',
        $emailValue[0]['value'])) {
      $response->addCommand(new HtmlCommand(
        '#form-system-messages-name',
        '<p class="ajax-validation-alert-text email-ajax-validation-alert-text">
                   Email isn`t correct.
                </p>'));
    }
    else {
      $response->addCommand(new HtmlCommand(
        '#form-system-messages-name',
        ''));
    }
    return $response;
  }

  /**
   * Tel. number validation.
   */
  public function validateTelAjax(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $telValue = $form_state->getValue('email');
    if (!preg_match('/[+0-9]{3} [0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/',
      $telValue[0]['value'])) {
      $response->addCommand(new HtmlCommand(
        '#form-system-messages-name',
        '<p class="ajax-form-message email-ajax-validation-alert-text">
                   Phone number isn`t correct.
                </p>'));
    }
    else {
      $response->addCommand(new HtmlCommand(
        '#form-system-messages-name',
        ''));
    }
    return $response;
  }

  /**
   * Action after successful submit.
   */
  public function save(array $form, FormStateInterface $form_state) {
    parent::save($form, $form_state);

    $entity      = $this->getEntity();
    $entity_type = $entity->getEntityType();

    $arguments = [
      '@entity_type' => $entity_type->getSingularLabel(),
      '%entity'      => $entity->label(),
      'link'         => $entity->toLink($this->t('View'), 'canonical')
        ->toString(),
    ];

    $this->logger($entity->getEntityTypeId())
      ->notice('Form was submited', $arguments);
    $this->messenger()
      ->addStatus($this->t('This guest was saved.', $arguments));

    $form_state->setRedirectUrl(Url::fromRoute('romaroma.form'));
  }

}
