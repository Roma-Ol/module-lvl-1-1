<?php

namespace Drupal\guestbook\Plugin\Validation\Constraint\Name;

use Symfony\Component\Validator\Constraint;

/**
 * Check if the name value fits the rule.
 *
 * @Constraint(
 *   id = "NameCheck",
 *   label = @Translation("Name check", context = "Validation"),
 * )
 */
class GuestbookNameConstraint extends Constraint {

  /**
   * The message to show if it`s not correct.
   *
   * @var string
   */
  public $uncorrectName = 'Entered name "%value" is not correct.';
}
