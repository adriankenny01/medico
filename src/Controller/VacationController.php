<?php

namespace App\Controller;

use App\Entity\Vacation;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VacationController extends Controller
{
    /**
     * @Route("/vacation", name="vacation_list")
     */
    public function index()
    {
        return $this->render('vacation/index.html.twig', [
            'controller_name' => 'VacationController',
        ]);

    }

    /**
     * @Route("/vacation/assign/{m_id}/{e_id}", name="vacation_assign")
     */
    public function assign(Request $request, $m_id, $e_id){
        $vacation = new Vacation();

        // $vacation = $this->getDoctrine()->getRepository(Vacation::class)->find($id);

        $form = $this->createFormBuilder($vacation)
            ->add('type', ChoiceType::class, [
                'choices' => 
                [
                    'Permiso' => 'Permiso', 
                    'Vacacion' => 'Vacacion'
                ],
                "attr"=>array('class' => 'form-control'),
                'label' => 'Tipo'
            ])
            ->add('date_init', DateType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => 'Fecha Inicio',
                'widget' => 'single_text'
            ))
            ->add('days_taken', IntegerType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Dias a tomar'))
            ->add('reason', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Razon' ))
            ->add('observations', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Observaciones'))

            ->add('medic_id', HiddenType::class, array('attr' =>
            array('class' => 'form-control'), 'data' => $m_id, 'label' => 'Id del medico', 'required' => false))

            ->add('employee_id', HiddenType::class, array('attr' =>
            array('class' => 'form-control'), 'data' => $e_id, 'label' => 'Id del Empleado', 'required' => false))
 
           
            ->add('save', SubmitType::class, array(
                'label' => 'Asignar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $vacation = $form->getData();
                
                $entityManager = $this->getDoctrine()->getManager();
                
                if($m_id){
                    $vacation->setMedicId($m_id);
                    $entityManager->persist($vacation);
                    $entityManager->flush();
                    return $this->redirectToRoute('medic_list');
                }else{
                    $vacation->setEmployeeId($e_id);
                    $entityManager->persist($vacation);
                    $entityManager->flush();
                    return $this->redirectToRoute('employee_list');
                }

                

            }

            return $this->render('vacation/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

}
