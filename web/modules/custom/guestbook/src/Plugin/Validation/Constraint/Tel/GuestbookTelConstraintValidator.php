<?php

namespace Drupal\guestbook\Plugin\Validation\Constraint\Tel;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the tel constraint.
 */
class GuestbookTelConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritDoc}
   */
  public function validate($value, Constraint $constraint) {
    $item = $value->value;
    if (!preg_match('/[+0-9]{3} [0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/', $item)) {
      $this->context->addViolation($constraint->uncorrectTel, ['%value' => $item]);
    }
  }

}
