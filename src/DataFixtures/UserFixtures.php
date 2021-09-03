<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $usersList = [
            [

                'firstname' => 'Maryem',
                'lastname' => 'BM',
                'email' => 'mariembenmassoud123@gmail.com',
                'password' => 'password',
                'role' => 'ROLE_ADMIN',

            ],

        ];

        foreach ($usersList as $userDetails) {
            $user = new User();
            $user->setPassword($this->passwordEncoder->encodePassword($user, $userDetails['password']))


                ->setFirstname($userDetails['firstname'])

                ->setLastname($userDetails['lastname'])

                ->setEmail($userDetails['email'])

                ->setRoles([$userDetails['role']]);


            $this->addReference('user-' . $userDetails['password'], $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
