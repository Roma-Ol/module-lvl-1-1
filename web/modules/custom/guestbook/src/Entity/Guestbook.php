<?php

namespace Drupal\guestbook\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

#TODO add correct redirects on delete.
#TODO publication date to normal format.

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
 */;
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
        'label'    => 'inline',
        'weight'   => 0,
        'settings' => [
          'placeholder' => 'A-Z / min-2 / max-100',
        ],
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
        'label'    => 'inline',
        'weight'   => 10,
        'settings' => [
          'placeholder' => 'Allowed values: Aa-Zz / _ / -',
        ],
      ])
      ->setDisplayOptions('view', [
        'label'    => 'inline',
        'weight'   => 10,
        'settings' => [
          'placeholder' => 'Allowed values: Aa-Zz / _ / -',
        ],
      ])
      ->setRequired(TRUE);

    $fields['tel'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Phone number'))
      ->addConstraint('TelCheck')
      ->setDisplayOptions('form', [
        'label'    => 'inline',
        'weight'   => 20,
        'settings' => [
          'placeholder' => '+XX XXX XXX XX XX',
        ],
      ])
      ->setDisplayOptions('view', [
        'label'    => 'inline',
        'weight'   => 20,
        'settings' => [
          'placeholder' => '+XX XXX XXX XX XX',
        ],
      ])
      ->setRequired(TRUE);

    $fields['feedback'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Tell us what you think'))
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
      ->setLabel(t('Profile Picture'))
      ->setDescription(t('.'))
      ->setSettings([
        'max_filesize'    => '5242880',
        'upload_location' => 'public://romaroma/',
        'file_extensions' => 'png jpg jpeg',
        'alt_field'       => FALSE,
      ])
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 40,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 40,
      ])
      ->setRequired(FALSE);

    $fields['feedbackPic'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Feedback Picture'))
      ->setRequired(TRUE)
      ->setSettings([
        'max_filesize'    => '5242880',
        'upload_location' => 'public://romaroma/',
        'file_extensions' => 'png jpg jpeg',
        'alt_field'       => FALSE,
      ])
      ->setDisplayOptions('form', [
        'label'  => 'inline',
        'weight' => 50,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'weight' => 50,
      ])
      ->setRequired(FALSE);

    $fields['date'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Date'))
      ->setDisplayOptions('view', [
        'label'    => 'inline',
        'settings' => [
          'format_type' => 'html_date',
        ],
        'weight'   => 60,
      ])
      ->setRequired(FALSE);

    return $fields;
  }

}
