<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class LatLngValidator
 * @author Arofikin Aleksandr <sashaaro@gmail.com>
 */
class LatLngValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint|LatLng $constraint
     * @return bool
     */
    public function validate($value, Constraint $constraint)
    {
        if (isset($value['lat']) && (!preg_match('/^[0-9\-\.]+$/', $value['lat'], $matches) || ($value['lat'] > 90 || $value['lat'] < -90))) {
            $this->context->buildViolation($constraint->latMessage, ['%value%' => $value['lat']])->atPath('[lat]')->addViolation();
        }

        if (isset($value['lng']) && (!preg_match('/^[0-9\-\.]+$/', $value['lng'], $matches) || ($value['lng'] > 180 || $value['lng'] < -180))) {
            $this->context->buildViolation($constraint->lngMessage, ['%value%' => $value['lng']])->atPath('[lng]')->addViolation();
        }
    }
}