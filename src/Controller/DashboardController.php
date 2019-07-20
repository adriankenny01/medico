<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Employee;
use App\Entity\Patient;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        $employee = $this->countEmployee();
        $patient = $this->countPatient();
       
        return $this->render('dashboard/index.html.twig', [
            'employee'  => $employee ,
            'patient'   => $patient
        ]);
    }

    private function countEmployee(){
        $employee = $this->getDoctrine()->getRepository(Employee::class)->countAll();

        return $employee;
    }

    private function countPatient(){
        $patient = $this->getDoctrine()->getRepository(Patient::class)->countAll();

        return $patient;
    }
}
