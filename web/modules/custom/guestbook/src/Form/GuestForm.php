<?php

namespace Drupal\guestbook\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\AjaxResponse;

$x = '';

class GuestForm extends ContentEntityForm {

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
        '<p class="email-ajax-validation-alert-text">
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
      ->addStatus($this->t('The file was saved - 2.', $arguments));

    $form_state->setRedirectUrl(Url::fromRoute('romaroma.form'));
  }

}
