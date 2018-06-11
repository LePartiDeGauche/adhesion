<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsPhonenumber extends Constraint
{
    public $message = 'Aucun numéro de téléphone n\'a été renseigné';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
