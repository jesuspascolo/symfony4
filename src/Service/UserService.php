<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;

class UserService
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function findAllUsers()
    {
        $usersTransform = [];
        $users = $this->em->getRepository('LoginBundle:User')->findAll();

        foreach($users as $user)
        {
            $userToTransform = [
                'id' => $user->getId(),
                'name'=> $user->getName(),
                'lastName'=> $user->getLastName(),
                'dni'=> $user->getDni(),
                'registryDate'=> $user->getRegistryDate()->format('d-m-Y')
            ];
            array_push($usersTransform, $userToTransform);
        }
        return $usersTransform;
    }
}