<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Employee;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        $employee = $this->countEmployee();
       
        return $this->render('dashboard/index.html.twig', [
            'employee' => $employee ,
        ]);
    }

    private function countEmployee(){
        $employee = $this->getDoctrine()->getRepository(Employee::class)->countAll();

        return $employee;
    }
}
