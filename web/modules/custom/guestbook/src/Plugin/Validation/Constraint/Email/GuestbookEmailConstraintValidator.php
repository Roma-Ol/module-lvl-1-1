<?php

namespace Drupal\guestbook\Plugin\Validation\Constraint\Email;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the name constraint.
 */
class GuestbookEmailConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritDoc}
   */
  public function validate($value, Constraint $constraint) {
    $item = $value->value;
    if (!filter_var($item, FILTER_VALIDATE_EMAIL) ||
      !preg_match('/^[A-Za-z1-9-_]+[@]+[a-z]+[.]+[a-z]+$/', $item)) {
      $this->context->addViolation($constraint->uncorrectEmail, ['%value' => $item]);
    }
  }

}
