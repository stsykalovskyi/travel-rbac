<?php

namespace App\DataFixtures;

use App\Entity\Trip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TripFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $description = 'Организатор придерживается рекомендаций по безопасности и уборке во время пандемии: соблюдает'.
            ' правила социального дистанциирования и нормы гигиены...';
        // $product = new Product();
        // $manager->persist($product);
        $countries = ['TR', 'HU', 'NL', 'US', 'HK', 'IL', 'JM', 'MV', 'IT', 'EG', 'HK'];
        $exts = ['jpg','jpg','jpg','jpeg','jpg','webp','jpg','jpg','jpeg', 'jpg', 'jpg'];
        $names = [
            'турцию',
            'венгрию',
            'нидерланды',
            'штаты',
            'гонг-конг',
            'израиль',
            'ямайку',
            'мальдивы',
            'италию',
            'египет',
            'гонг-конг'
        ];
        for ($j = 0; $j<10; $j++) {
            for ($i = 0; $i < 6; $i++) {
                $trip = new Trip();
                $trip->setCountry($countries[$j])
                    ->setDescription($description)
                    ->setPrice($i*100+100)
                    ->setSubject(sprintf('Экскурсия в(на) %s', $names[$j]))
                    ->setResource(sprintf('%s.%s', $countries[$j], $exts[$j]));
                $manager->persist($trip);
            }
        }

        $manager->flush();
    }
}
