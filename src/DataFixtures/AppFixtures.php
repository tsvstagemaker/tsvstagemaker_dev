<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Stage;
use App\Entity\Matchs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $generator = Faker\Factory::create("fr_FR");

       // Fixtures User
        for($i = 0; $i < 45; $i++){
        	
        	$user = (new User())

        	->setUsername($generator->Username())
        	->setFirstName($generator->FirstName)
        	->setEmail($generator->email)
        	->setDivision('Standard')
        	->setClub('CTCM')
        	->setRegion($generator->region)
        	->setPassword('password');

        	$manager->persist($user);
        }


        // Fixtures Matchs
        for($h = 0; $h < 10; $h++){
        	
        	$match = (new Matchs())

        	->setName($generator->Username())
        	->setFirearmtype(rand(1, 7))
        	->setMatchlevel('3')
        	->setStartAt($generator->randomDigit)
        	->setMatchDirector('Henri')
        	->setRangemaster('Patrick')
        	->setStatsdirector('Jean')
        	->setClubname('CTCM')
        	->setCountryid('FRA')
        	->setSquadcount($generator->randomDigit)
        	->setMatchid('1')
        	->setUser($user);

        	
        	$manager->persist($match);
        }


           for($j = 0; $j < 32; $j++){
        	
        	$stage = (new Stage())

        	->setStagename($generator->sentence())
        	->setStagenumber($j)
        	->setFirearmid($generator->randomDigit)
        	->setCourseid($generator->randomDigit)
        	->setScoringid('1')
        	->setTrgttypeid($generator->randomDigit)
        	->setIcsstageid('3')
        	->setTrgtpaper($generator->randomDigit)
        	->setTrgtpopper($generator->randomDigit)
        	->setTrgtplates($generator->randomDigit)
        	->setTrgtvanish($generator->randomDigit)
        	->setTrgtpenlty($generator->randomDigit)
        	->setMinrounds($generator->randomDigit)
        	->setReporton('1')
        	->setMaxpoints($generator->randomDigit)
        	->setStartpos($generator->paragraph())
        	->setStarton('1')
        	->setStringcnt('1')
        	->setDescriptn($generator->paragraph())
        	->setBobber($generator->randomDigit)
        	->setShowall('0')
        	->setLocation('0')
        	->setFilename('password')
        	->setFileurl('password')
        	->setFilenameimg('password')
        	->setFileurlimg('password')
        	->setDatastage('password')
        	->setMatchsId($match)
        	->setUser($user);
        	

        	$manager->persist($stage);
        }


        $manager->flush();
    }
}
