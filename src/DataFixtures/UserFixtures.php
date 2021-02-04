<?php


namespace App\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $admin = new User();

        $admin->setEmail('lavergne.marcel@gmail.com');

        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword($this->passwordEncoder->encodePassword(

            $admin,

            'password2moi'

        ));


        $manager->persist($admin);
        $manager->flush();
    }
}
