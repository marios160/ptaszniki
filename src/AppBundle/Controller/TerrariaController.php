<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TerrariumType;
use AppBundle\Entity\Terrarium;
/**
 * Description of TerrariaController
 *
 * @author Mateusz Błaszczak
 */
class TerrariaController extends Controller{
   /**
     * @Route("/terraria", name="showTerraria")
     */
    public function showAction() {
        $terraria = $this->getDoctrine()->getRepository('AppBundle:Terrarium')->findAll();

        return $this->render('@App/Terraria/show.html.twig', array('terraria' => $terraria));
    }

    /**
     * @Route("/terraria/add", name="addTerrarium")
     */
    public function addAction(Request $request) {
        $terrarium = new Terrarium();
        $form = $this->createForm(TerrariumType::class, $terrarium);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($terrarium);
            $em->flush();
            $this->addFlash(
                    'notice', 'Dodano terrarium!'
            );
            return $this->redirectToRoute('showTerraria');
        }

        return $this->render('@App/Terraria/add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/terraria/delete", name="deleteTerrarium")
     */
    public function deleteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $terrarium = $em->getReference('AppBundle:Terrarium', $request->get('id'));
        $em->remove($terrarium);
        $em->flush();
        $this->addFlash(
                'notice', 'Usunięto Terrarium!'
        );
        return $this->redirectToRoute('showTerraria');
    }

    /**
     * @Route("/terraria/edit", name="editTerrarium")
     */
    public function editAction(Request $request) {
        $terrarium = $this->getDoctrine()->getRepository('AppBundle:Terrarium')->find($request->get('id'));
        $form = $this->createForm(TerrariumType::class, $terrarium);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($terrarium);
            $em->flush();
            $this->addFlash(
                    'notice', 'Zapisano zmiany!'
            );
            return $this->redirectToRoute('showTerraria');
        }

        return $this->render('@App/Terraria/edit.html.twig', array('form' => $form->createView()));
    }
}
