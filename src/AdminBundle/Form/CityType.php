<?php

namespace AdminBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CityType
 * @package AdminBundle\Form
 */
class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'Название'
        ]);
        $builder->add('region', EntityType::class, [
            'label' => 'Регион',
            'class' => Region::class,
            'group_by' => 'country'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class
        ]);
    }


}