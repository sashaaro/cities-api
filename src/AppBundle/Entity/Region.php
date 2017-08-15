<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Region
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"region_view"})
     */
    private $id;

    /**
     * @var string Something else
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     *
     * @Groups({"region_view"})
     */
    private $name;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @Assert\NotBlank
     *
     * @Groups({"region_view"})
     */
    private $country;

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
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function __toString()
    {
        return $this->name;
    }
}
