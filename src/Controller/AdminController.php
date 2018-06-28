<?php

namespace App\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Rest\Route("/admin", name="admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return View::create(['mensaje' => 'Bienvenido Administrador'],Response::HTTP_OK, []);
    }

    /**
     * @Rest\Get("/find-all-users", name="find-all-users")
     */
    public function findAllUsers()
    {
        $allUsers = $this->get('app.service.admin.service')->findAllUsers();
        return View::create($allUsers,Response::HTTP_OK, []);
    }

    /**
     * @Rest\Post("/modify-user", name="modify-user")
     * @param Request $request
     * @return View
     */
    public function modifyUser(Request $request)
    {
        $content = $request->getContent();
        $contentJson = json_decode($content);
        $userToModify = $this->get('app.service.admin.service')->modifyUser($contentJson);
        return View::create($userToModify,Response::HTTP_OK, []);
    }

    /**
     * @Rest\Get("/user", name="user")
     * @Rest\QueryParam(name="userId", requirements="\d+", nullable=false)
     * @param Request $request
     * @return View
     */
    public function showUser(Request $request)
    {
        $userId = $request->get('userId');
        $userToShow = $this->get('app.service.admin.service')->showUser($userId);
        return View::create($userToShow,Response::HTTP_OK, []);
    }

    /**
     * @Rest\Post("/delete-user", name="delete-user")
     * @Rest\QueryParam(name="userId", requirements="\d+", nullable=false)
     * @param Request $request
     * @return View
     */
    public function deleteUser(Request $request)
    {
        $userId = $request->get('userId');
        $userToDelete = $this->get('app.service.admin.service')->deleteUser($userId);
        return View::create($userToDelete,Response::HTTP_OK, []);
    }

    /**
     * @Rest\Post("/new-user", name="new-user")
     * @param Request $request
     * @return View
     */
    public function createUser(Request $request)
    {
        $content = $request->getContent();
        $contentJson = json_decode($content);
        $userToCreate = $this->get('app.service.admin.service')->createUser($contentJson);
        return View::create($userToCreate,Response::HTTP_OK, []);
    }
}
