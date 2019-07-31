<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SuperadminFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setUsername("rokhina");
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $password = $this->encoder->encodePassword($user, '1234');
        $user->setPassword($password);
        $user->setNomcomplet("Mame Daba Diop");
        $user->setMail("mamediop@gmail.com");
        $user->setTel(77855565);
        $user->setAdresse("dakar");

        $manager->persist($user);

        $manager->flush();
    }
}
