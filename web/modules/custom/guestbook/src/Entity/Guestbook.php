<?php

namespace Drupal\guestbook\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Implementing the specific functionality.
 *
 * @ContentEntityType(
 *   id = "Guestbook",
 *   label = @Translation("Guestbook"),
 *   base_table = "guestbookdatabase",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   handlers = {
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\guestbook\Form\GuestForm",
 *       "edit" = "Drupal\guestbook\Form\GuestForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "permission_provider" = "Drupal\Core\Entity\EntityPermissionProvider",
 *     "route_provider" = {
 *       "default" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/guest/{Guestbook}",
 *     "add-form" = "/guestbook/add",
 *     "edit-form" = "/guestbook/edit/{Guestbook}",
 *     "delete-form" = "/guestbook/delete/{Guestbook}",
 *   },
 *   admin_permission = "administer nodes",
 * )
 */
class Guestbook extends ContentEntityBase {

  /**
   * Defining the fields.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    // Get the field definitions for 'id' and 'uuid' from the parent.
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->addConstraint('NameCheck')
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 0,
      ])
      ->setRequired(TRUE);

    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->addConstraint('EmailCheck')
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 10,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 10,
      ])
      ->setRequired(TRUE);

    $fields['tel'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Tel'))
      ->addConstraint('TelCheck')
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 20,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 20,
      ])
      ->setRequired(TRUE);

    $fields['feedback'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Feedback'))
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 30,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 30,
      ])
      ->setRequired(TRUE);

    $fields['profilePic'] = BaseFieldDefinition::create('image')
      ->setLabel(t('profilePic'))
      ->setSettings([
        'max_filesize'       => '5242880',
        'upload_location'    => 'public://romaroma/',
        'file_extensions'    => 'png jpg jpeg',
        'alt_field_required' => FALSE,
      ])
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 40,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 40,
      ])
      ->setRequired(TRUE);

    $fields['feedbackPic'] = BaseFieldDefinition::create('image')
      ->setLabel(t('feedbackPic'))
      ->setRequired(TRUE)
      ->setSettings([
        'max_filesize'       => '5242880',
        'upload_location'    => 'public://romaroma/',
        'file_extensions'    => 'png jpg jpeg',
        'alt_field_required' => FALSE,
      ])
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 50,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 50,
      ])
      ->setRequired(TRUE);

    $fields['date'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Date'))
      ->setDisplayOptions('view', [
        'label'    => 'inline',
        'settings' => [
          'format_type' => 'html_date',
        ],
        'weight'   => 60,
      ])
      ->setRequired(TRUE);

    return $fields;
  }

}
