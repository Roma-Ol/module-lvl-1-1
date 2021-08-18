<?php

namespace Drupal\guestbook\Plugin\Validation\Constraint\Tel;

use Symfony\Component\Validator\Constraint;

/**
 * Check if the name value fits the rule.
 *
 * @Constraint(
 *   id = "TelCheck",
 *   label = @Translation("Tel check", context = "Validation"),
 * )
 */
class GuestbookTelConstraint extends Constraint {

  /**
   * The message to show if it`s not correct.
   *
   * @var string
   */
  public $uncorrectTel = 'Entered tel "%value" is not correct.';
  
}
