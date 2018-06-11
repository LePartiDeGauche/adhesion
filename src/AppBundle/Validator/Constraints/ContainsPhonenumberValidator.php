<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsPhonenumberValidator extends ConstraintValidator
{
    public function validate($object, Constraint $constraint)
    {
        if (null === $object->getPhoneNumber() && null === $object->getMobilephone()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('phonenumber')
                ->addViolation();
        }
    }
}
