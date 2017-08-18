<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 18.08.17
 * Time: 8:54
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class LatLng extends Constraint
{
    public $latMessage = 'The %value% latitude is not valid.';
    public $lngMessage = 'The %value% longitude is not valid.';
}