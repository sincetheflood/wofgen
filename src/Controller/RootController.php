<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use function Symfony\Component\String\u;

class RootController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(RouterInterface $router): Response
    {
        $allRoutes = $router->getRouteCollection()->all();

        $generatorRoutes = [];
        foreach ($allRoutes as $routeName => $route) {
            if (strpos($routeName, 'app_generator_') === 0) {
                // Trim the "app_generator_" off of the name
                $name = str_replace('app_generator_', '', $routeName);
                // Then turn the name into a "title" (replace underscores with spaces, capitalize each word)
                $prettyName = u($name)->replace('_', ' ')->title(true)->toString();
                $generatorRoutes[$prettyName] = $routeName;
            }
        }


        return $this->render('root/index.html.twig', [
            'controller_name' => 'RootController',

            'generators' => $generatorRoutes,
        ]);
    }
}
