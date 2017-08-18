<?php

namespace AppBundle\Action;

use AppBundle\Service\DistanceCalculator;
use AppBundle\Validator\Constraints\LatLng;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * Class CheckLocationAction
 */
class CheckLocationAction
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route(
     *     name="api_check_location",
     *     path="/check_location",
     * )
     */
    public function __invoke(Request $request)
    {
        $requestQuery = $request->query->all();
        $violationList = $this->validator->validate($requestQuery, [
            new Assert\Collection(['fields' => [
                'address' => [
                    new Assert\NotBlank()
                ],
                'lat' => [
                    new Assert\NotBlank()
                ],
                'lng' => [
                    new Assert\NotBlank()
                ],
                'radius' => [
                    new Assert\NotBlank(),
                    new Assert\Type(['type' => 'numeric']),
                ],
            ]]),
            new LatLng()
        ]);
        if ($violationList->count() > 0) {
            $errors = [];
            /** @var $violation ConstraintViolationInterface */
            foreach ($violationList as $violation) {
                $path = $violation->getPropertyPath();
                if (!$path) {
                    $path = '_error';
                }

                $errors[$path] = $violation->getMessage();
            }
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $address = $request->get('address');
        $radius = $request->get('radius');

        $lat = floatval($requestQuery['lat']);
        $lng = floatval($requestQuery['lng']);

        try {
            $addressLocation = DistanceCalculator::resolveCoordinates($address);
        } catch (\InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $distance = DistanceCalculator::calculate($lat, $lng, $addressLocation['lat'], $addressLocation['lng']);

        return new JsonResponse([
            'distance' => $distance,
            'result' => $distance <= $radius
        ]);
    }
}