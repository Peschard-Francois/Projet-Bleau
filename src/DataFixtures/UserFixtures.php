<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function __construct()
    {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('michel@donkey.fr');
        $user->setName("Michel");
        $user->setPassword('donkey');
        $user->setCreateDate(new \datetime("2022/10/11"));
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('michel2@donkey.fr');
        $user->setName("Miche2l");
        $user->setPassword('donkey2');
        $user->setCreateDate(new \datetime("2022/10/11"));
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
