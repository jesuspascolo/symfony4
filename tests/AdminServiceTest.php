<?php

namespace App\Tests;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\AdminService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class AdminServiceTest extends TestCase
{
    public function testShowUser()
    {
        $date = new \DateTime('2018-06-21');
        $user = new User();
        $user->setId(3);
        $user->setLastName('Pérez');
        $user->setName('Ricardo');
        $user->setPassword('1234');
        $user->setDni('59209911K');
        $user->setRegistryDate($date);

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->any())
            ->method('find')
            ->willReturn($user);

        $userManager = $this->createMock(EntityManager::class);
        $userManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($userRepository);

        $userTransform = [
            'id' => $user->getId(),
            'name'=> $user->getName(),
            'lastName'=> $user->getLastName(),
            'dni'=> $user->getDni(),
            'registryDate'=> $user->getRegistryDate()->getTimestamp()
        ];

        $userFounded = new AdminService($userManager);
        $this->assertEquals($userTransform, $userFounded->showUser(3));
    }
}
