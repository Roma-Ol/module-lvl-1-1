<?php

namespace Drupal\guestbook\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class FirstPageController.
 *
 * Works on specific  class.
 *
 * Contains \Drupal\guestbook\Controller\FirstPageController.
 */
class FirstPageController extends ControllerBase {

  /**
   * Do some func.
   *
   * @var \Drupal\romaroma\Controller\FirstPageController
   */
  protected $formBuild;

  protected $entityBuild;

  /**
   * Creating a container for form rendering.
   */
  public static function create(ContainerInterface $container) {
    $instance              = parent::create($container);
    $instance->formBuild   = $container->get('entity.form_builder');
    $instance->entityBuild = $container->get('entity_type.manager');
    return $instance;
  }

  /**
   * Getting the Form and render it.
   */
  public function build() {
    $entity        = $this->entityBuild
      ->getStorage('Guestbook')
      ->create([
        'entity_type' => 'node',
        'entity'      => 'Guestbook',
      ]);
    $guestbookform = $this->formBuild->getForm($entity, 'add');
    return $guestbookform;
  }

  /**
   * Creating a table from DB.
   */
  public function load() {
    $query  = \Drupal::database();
    $result = $query->select('guestbookdatabase', 'g')
      ->fields('g', [
        'id',
        'uuid',
        'name',
        'email',
        'tel',
        'feedback',
        'date',
        'profilePic__target_id',
        'feedbackPic__target_id',
      ])
      ->orderBy('date', 'DESC')
      ->execute()->fetchAll(\PDO::FETCH_OBJ);

    return $result;
  }

  /**
   * Telling what to return.
   */
  public function report() {
    \Drupal::service('page_cache_kill_switch')->trigger();
    // Building the form.
    $form   = $this->build();
    $result = $this->load();
    foreach ($result as $row) {
      // Putting all the data we need into one variable.

      // Getting the profile picture.
      $profilePic         = file::load($row->profilePic__target_id);
      $profilePicUri      = $profilePic->getFileUri();
      $profilePicUrl      = file_url_transform_relative(Url::fromUri(file_create_url($profilePicUri))
        ->toString());
      $profilePicVariable = [
        '#theme' => 'image',
        '#uri'   => $profilePicUri,
        '#alt'   => 'Profile picture',
        '#title' => 'Profile picture',
      ];

      // Getting the feedback picture.
      $feedbackPic         = file::load($row->feedbackPic__target_id);
      $feedbackPicUri      = $feedbackPic->getFileUri();
      $feedbackPicUrl      = file_url_transform_relative(Url::fromUri(file_create_url($feedbackPicUri))
        ->toString());
      $feedbackPicVariable = [
        '#theme' => 'image',
        '#uri'   => $feedbackPicUri,
        '#alt'   => 'Profile picture',
        '#title' => 'Profile picture',
      ];

      // Variable we'll work with in twig file.
      $data[] = [
        'id'              => $row->id,
        'name'            => $row->name,
        'email'           => $row->email,
        'tel'             => $row->tel,
        'feedback__value' => $row->feedback,
        'date'            => $row->date,
        'profilePic'      => [
          'data' => $profilePicVariable,
          'url'  => $profilePicUrl,
        ],
        'feedbackPic'     => [
          'data' => $feedbackPicVariable,
          'url'  => $feedbackPicUrl,
        ],
      ];
    }

    $value = $this->getDestinationArray();
    $let   = $value["destination"];

    // Rendering the data we need.
    return [
      '#theme'   => 'guest-theme',
      '#form'    => $form,
      '#content' => empty($data) ? '' : $data,
      '#getDest' => $let,
    ];

  }

}