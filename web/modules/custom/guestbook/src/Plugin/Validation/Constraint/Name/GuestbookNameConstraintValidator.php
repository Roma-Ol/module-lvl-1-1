<?php

namespace Drupal\guestbook\Plugin\Validation\Constraint\Name;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the name constraint.
 */
class GuestbookNameConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritDoc}
   */
  public function validate($value, Constraint $constraint) {
    $item = $value->value;

    if (!preg_match(
        '/^[A-Za-z]*$/', $item) || strlen($item) <= 2 ||
      strlen($item) >= 100 || $nameValue = "") {
      $this->context->addViolation($constraint->uncorrectName, ['%value' => $item]);
    }
  }

}
