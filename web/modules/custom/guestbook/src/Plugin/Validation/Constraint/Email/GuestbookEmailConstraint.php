<?php

namespace Drupal\guestbook\Plugin\Validation\Constraint\Email;

use Symfony\Component\Validator\Constraint;

/**
 * Check if the name value fits the rule.
 *
 * @Constraint(
 *   id = "EmailCheck",
 *   label = @Translation("Email check", context = "Validation"),
 * )
 */
class GuestbookEmailConstraint extends Constraint {

  /**
   * The message to show if it`s not correct.
   *
   * @var string
   */
  public $uncorrectEmail = 'Entered email "%value" is not correct.';
}
