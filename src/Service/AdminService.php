<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class AdminService
{
    private $_em;
    private $_success = 'Operation success';
    private $_fail = 'Operation fail';

    public function __construct(EntityManager $entityManager)
    {
        $this->_em = $entityManager;
    }

    public function findAllUsers()
    {
        $usersTransform = [];
        $users = $this->_em->getRepository(User::class)->findAll();

        foreach($users as $user)
        {
            $userToTransform = [
                'id' => $user->getId(),
                'name'=> $user->getName(),
                'lastName'=> $user->getLastName(),
                'dni'=> $user->getDni(),
                'registryDate'=> $user->getRegistryDate()->getTimestamp()
            ];
            array_push($usersTransform, $userToTransform);
        }
        return $usersTransform;
    }

    public function modifyUser($userJson)
    {
        $message = ['message' => ''];
        $id = $userJson->id;
        if(isset($id)) {
            $userToModify = $this->_em->getRepository(User::class)->find($id);
            if(isset($userJson->name)){
                $userToModify->setName($userJson->name);
            }
            if(isset($userJson->lastName)){
                $userToModify->setLastName($userJson->lastName);
            }
            if(isset($userJson->dni)){
                $userToModify->setDni($userJson->dni);
            }
            if(isset($userJson->password)){
                $userToModify->setPassword($userJson->password);
            }
            if(isset($userJson->registryDate)){
                $date = DateTime::createFromFormat('j-M-Y', $userJson->registryDate);
                $userToModify->setRegistryDate($date);
            }
            $this->_em->persist($userToModify);
            $this->_em->flush();
            $message['message'] = $this->_success;
        } else {
            $message['message'] = $this->_fail;
        }
        return $message;
    }

    public function showUser($userId)
    {
        if(isset($userId)) {
            $userToShow = $this->_em->getRepository(User::class)->find($userId);
            $userTransform = [
                'id' => $userToShow->getId(),
                'name'=> $userToShow->getName(),
                'lastName'=> $userToShow->getLastName(),
                'dni'=> $userToShow->getDni(),
                'registryDate'=> $userToShow->getRegistryDate()->getTimestamp()
            ];
            return $userTransform;
        } else {
            return $message= ['mensaje' => 'No se encuentra el usuario'];
        }
    }

    public function deleteUser($userId)
    {
        $message = ['message' => ''];

        if(isset($userId)) {
            $userToDelete = $this->_em->getRepository(User::class)->find($userId);
            $this->_em->remove($userToDelete);
            $this->_em->flush();
            return $message['message'] = $this->_success;
        } else {
            return $message['message'] = $this->_fail;
        }
    }

    public function createUser($userJson)
    {
        $message = ['message' => ''];
        $userToCreate = new User();

        if(isset($userJson->name)){
            $userToCreate->setName($userJson->name);
        }
        if(isset($userJson->lastName)){
            $userToCreate->setLastName($userJson->lastName);
        }
        if(isset($userJson->dni)){
            $userToCreate->setDni($userJson->dni);
        }
        if(isset($userJson->password)){
            $userToCreate->setPassword($userJson->password);
        }
        if(isset($userJson->registryDate)){
            $date = DateTime::createFromFormat('j-M-Y', $userJson->registryDate);
            $userToCreate->setRegistryDate($date);
        } else {

        }
        $this->_em->persist($userToCreate);
        $this->_em->flush();

        if(!$this->_em->getRepository(User::class)->find($userToCreate->getId())){
            $message['message'] = $this->_fail;
        } else {
            $message['message'] = $this->_success;
        }

        return $message;
    }
}