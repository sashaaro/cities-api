<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(attributes={
 *      "normalization_context"={"groups"={"city_view", "region_view", "country_view"}},
 * })
 * @ORM\Entity
 */
class City
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"city_view"})
     */
    private $id;

    /**
     * @var string Something else
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     *
     * @Groups({"city_view"})
     */
    private $name;

    /**
     * @var Region
     *
     * @ORM\ManyToOne(targetEntity="Region")
     * @Assert\NotBlank
     *
     * @Groups({"city_view"})
     */
    private $region;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param Region $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }
}
