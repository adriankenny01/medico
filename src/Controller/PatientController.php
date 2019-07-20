<?php

namespace App\Controller;

use App\Entity\Patient;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PatientController extends Controller
{
    /**
     * @Route("/patient", name="patient_list")
     */
    public function index()
    {
        $patients = $this->getDoctrine()->getRepository(Patient::class)->findAll();

        return $this->render('patient/index.html.twig' , array
        ('patients' => $patients ));
    }

    /**
     * 
     * @Route("/patient/new", name="new_patient")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $patient = new Patient();

        $form = $this->createFormBuilder($patient)
            ->add('full_name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre Completo'))
            ->add('email', EmailType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Email'))
            ->add('card_id', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Cedula'))
            ->add('address', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Direccion'))
            ->add('phone', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Telefono'))
            ->add('social_security', IntegerType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Seguridad Social'))
            
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $patient = $form->getData();

                $patient->setState(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($patient);
                $entityManager->flush();

                return $this->redirectToRoute('patient_list');
            }

            return $this->render('patient/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/patient/edit/{id}", name="update_patient")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $patient = new Patient();

        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);

        $form = $this->createFormBuilder($patient)
            ->add('full_name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre Completo'))
            ->add('email', EmailType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Email'))
            ->add('card_id', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Cedula'))
            ->add('address', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Direccion'))
            ->add('phone', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Telefono'))
            ->add('social_security', IntegerType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Seguridad Social'))

            ->add('save', SubmitType::class, array(
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('patient_list');
            }

            return $this->render('patient/edit.html.twig', array(
                'form' => $form->createView(),
                'full_name' => $patient->getFullName()
            ));
    }

    /**
     * @Route("/patient/{id}",  name="patient_show")
     */
    public function show($id) {
        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);

        return $this->render('patient/show.html.twig' , array
        ('patient' => $patient ));
    }

    /**
     * @Route("/patient/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($patient);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}
