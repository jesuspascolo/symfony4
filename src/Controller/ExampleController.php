<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;

class ExampleController extends Controller
{
    /**
     * @Route("/example", name="example")
     */
    public function index()
    {
        return new View(['message' => 'Welcome to your new controller!']);
    }
}
