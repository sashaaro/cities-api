<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LoadFixturesCommand
 */
class LoadFixturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:fixtures:load');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = [
            'Россия' => [
                'Московская область' => [
                    'пос Быково',
                    'Некрасовка'
                ],
                'Волгоградская область' => [
                    'пос Быково',
                    'Михайловка',
                    'Белые Пруды'
                ]
            ],
            'USA' => [
                'California' => [
                    'Mountain View'
                ]
            ]
        ];

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        foreach ($data as $countryName => $regions)
        {
            $country = new \AppBundle\Entity\Country();
            $country->setName($countryName);
            $em->persist($country);
            foreach ($regions as $regionName => $cities)
            {
                $region = new \AppBundle\Entity\Region();
                $region->setName($regionName);
                $region->setCountry($country);
                $em->persist($region);
                foreach ($cities as $cityName) {
                    $city = new \AppBundle\Entity\City();
                    $city->setName($cityName);
                    $city->setRegion($region);
                    $em->persist($city);
                }
            }
            $em->flush();
        }

        $output->writeln(sprintf("Done"));
    }
}