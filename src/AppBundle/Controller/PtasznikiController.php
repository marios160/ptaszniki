<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Repository\PtasznikRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\PtasznikType;
use AppBundle\Entity\Ptasznik;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PtasznikiController extends Controller {

    /**
     * @Route("/ptaszniki/{currentPage}", defaults={"currentPage" = 1}, 
     *  name="showPtaszniki", requirements={"currentPage": "\d+"})
     */
    public function showAction(Request $request, $currentPage) {

        $session = $request->getSession();

        /* if ($request->get('field') != "") {
          $order = "";
          $field = "";
          if ($session->has('field') && $session->get('field') != $request->get('field')) {
          $order = "DESC";
          $field = $request->get('field');
          } else {
          $field = $request->get('field');
          if ($session->get('order') == "ASC") {
          $order = "DESC";
          } else {
          $order = "ASC";
          }
          }
          $session->set('field', $field);
          $session->set('order', $order);
          } else */ if ($request->get('find') != "") {
            $session->set('find', $request->get('find'));
            $currentPage = 1;
        } else {
            /* $session->set('field', "");
              $session->set('order', ""); */
            $session->set('find', "");
        }
        //$ptaszniki = $this->getDoctrine()->getRepository('AppBundle:Ptasznik')->findBySession($session);
        $limit = 100;
        $em = $this->getDoctrine()->getManager();
        $ptaszniki = $em->getRepository('AppBundle:Ptasznik')->findBySession($session, $currentPage, $limit);

        $maxPages = ceil($ptaszniki->count() / $limit);
        $thisPage = $currentPage;

        return $this->render('@App/Ptaszniki/show.html.twig', array(
                    'ptaszniki' => $ptaszniki,
                    'maxPages' => $maxPages,
                    'thisPage' => $thisPage
                        //'all_items' => $allSpecificItems
        ));
        //return $this->render('@App/Ptaszniki/show.html.twig', array('ptaszniki' => $ptaszniki));
    }

    /**
     * @Route("/ptaszniki/czynnosc", name="czynnoscPtasznik")
     */
    public function czynnoscAction(Request $request) {
        switch ($request->get('czynnosc')) {
            case 'deletePtasznik':
                if (empty($request->get('chck')) == false) {
                    return $this->redirect($this->generateUrl('deletePtasznik', array('chck' => $request->get('chck'))));
                } else {
                    $this->addFlash(
                            'notice', 'Proszę zaznaczyć pozycję!'
                    );
                    return $this->redirectToRoute('showPtaszniki');
                }
            case 'addZdarzenie' :
                if (empty($request->get('chck')) == false) {
                    return $this->redirect($this->generateUrl('addZdarzeniePtasznik', array('chck' => $request->get('chck'))));
                } else {
                    $this->addFlash(
                            'notice', 'Proszę zaznaczyć pozycję!'
                    );
                    return $this->redirectToRoute('showPtaszniki');
                }
            case 'editPtasznik':
                if (empty($request->get('chck')) == false) {
                    return $this->redirect($this->generateUrl('editPtasznik', array('chck' => $request->get('chck'))));
                } else {
                    $this->addFlash(
                            'notice', 'Proszę zaznaczyć pozycję!'
                    );
                    return $this->redirectToRoute('showPtaszniki');
                }
            case 'addPtasznik':
                return $this->redirect($this->generateUrl('addPtasznik'));
        }
        //while($request->get('chck'))
        // $request->get('chck')
    }

    /**
     * @Route("/ptaszniki/delete", name="deletePtasznik")
     */
    public function deleteAction(Request $request) {
        foreach ($request->get('chck') as $chck) {
            $em = $this->getDoctrine()->getManager();
            $ptasznik = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($chck);
            $em->remove($ptasznik);
            $em->flush();
        }
        $this->addFlash(
                'notice', 'Usunięto wybrane rekordy!'
        );
        return $this->redirectToRoute('showPtaszniki');
    }

    /**
     * @Route("/ptaszniki/add", name="addPtasznik")
     */
    public function addPtasznikAction(Request $request) {
        $magazyny = $this->getDoctrine()->
                        getRepository('AppBundle:Magazyn')->findAll();
        $terraria = $this->getDoctrine()->
                        getRepository('AppBundle:Terrarium')->findAll();
        return $this->render('@App/Ptaszniki/add.html.twig', array(
                    'magazyny' => $magazyny,
                    'terraria' => $terraria));
    }

    /**
     * @Route("/ptaszniki/addZdarzenie", name="addZdarzeniePtasznik")
     */
    public function addZdarzenieAction(Request $request) {
        if (!empty($request->get('chck'))) {
            $chck = $request->get('chck');
            $em = $this->getDoctrine()->getManager();
            if (count($chck) > 1) {
//                $ptasznik = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($chck[0]);
//                $ptasznik2 = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($chck[count($chck) - 1]);
                return $this->redirectToRoute('addMultiAreaZdarzenie', array('ptasznik' => $chck));
            } else {
//                $ptasznik = $em->getRepository('AppBundle:Ptasznik')->find($chck[0]);
                return $this->redirectToRoute('addZdarzenie', array('ptasznik' => $chck[0]));
            }
        }
        return $this->redirectToRoute('showPtaszniki');
    }

    /**
     * @Route("/ptaszniki/edit", name="editPtasznik")
     */
    public function editAction(Request $request) {
        $ptaszniki = $this->getDoctrine()->
                        getRepository('AppBundle:Ptasznik')->findByKodEans($request->get('chck'));
        $magazyny = $this->getDoctrine()->
                        getRepository('AppBundle:Magazyn')->findAll();
        $terraria = $this->getDoctrine()->
                        getRepository('AppBundle:Terrarium')->findAll();
        return $this->render('@App/Ptaszniki/edit.html.twig', array('ptaszniki' => $ptaszniki,
                    'magazyny' => $magazyny,
                    'terraria' => $terraria));
    }

    /**
     * @Route("/ptaszniki/editZapisz", name="editZapiszPtasznik")
     */
    public function editZapiszAction(Request $request) {
        //echo$request->get('ptaszniki') ;
        foreach ($request->get('ptasznikiEdit') as $p) {
            $em = $this->getDoctrine()->getManager();
            $ptasznik = $em->getRepository('AppBundle:Ptasznik')->find($p['id']);
            $magazyn = $em->getRepository('AppBundle:Magazyn')->find($p['magazyn']);
            $terrarium = $em->getRepository('AppBundle:Terrarium')->find($p['terrarium']);
            if (!$ptasznik) {
                throw $this->createNotFoundException(
                        'No ptasznik found for id ' . $id
                );
            }
            $ptasznik->setKodEan($p['kodEan']);
            $ptasznik->setNazwaLacinska($p['nazwaLacinska']);
            $ptasznik->setNazwaPolska($p['nazwaPolska']);
            $ptasznik->setUwagi($p['uwagi']);
            $ptasznik->setKodDostawy($p['kodDostawy']);
            $ptasznik->setMagazyn($magazyn);
            $ptasznik->setTerrarium($terrarium);
            $ptasznik->setZakupRozmiar($p['zakupRozmiar']);
            $ptasznik->setAktualnyRozmiar($p['aktualnyRozmiar']);
            $ptasznik->setPlec($p['plec']);
            $ptasznik->setLpWPartii($p['lpWPartii']);
            $ptasznik->setWydrukEtykiety($p['wydrukEtykiety']);
            $em->flush();
        }
        $this->addFlash(
                'notice', 'Zapisano zmiany!'
        );
        return $this->redirectToRoute('showPtaszniki');
    }

    /**
     * @Route("/ptaszniki/addZapisz", name="addZapiszPtasznik")
     */
    public function addZapiszAction(Request $request) {
        //echo$request->get('ptaszniki') ;

        $p = $request->get('ptasznik');

        try {
            $em = $this->getDoctrine()->getManager();
            $magazyn = $em->getRepository('AppBundle:Magazyn')->find($p['magazyn']);
            $terrarium = $em->getRepository('AppBundle:Terrarium')->find($p['terrarium']);
            $ptasznik = new Ptasznik();
            $ptasznik->setKodEan($p['kodEan']);
            $ptasznik->setNazwaLacinska($p['nazwaLacinska']);
            $ptasznik->setNazwaPolska($p['nazwaPolska']);
            $ptasznik->setUwagi($p['uwagi']);
            $ptasznik->setKodDostawy($p['kodDostawy']);
            $ptasznik->setMagazyn($magazyn);
            $ptasznik->setTerrarium($terrarium);
            $ptasznik->setZakupRozmiar($p['zakupRozmiar']);
            $ptasznik->setAktualnyRozmiar($p['aktualnyRozmiar']);
            $ptasznik->setPlec($p['plec']);
            $ptasznik->setLpWPartii($p['lpWPartii']);
            $ptasznik->setWydrukEtykiety($p['wydrukEtykiety']);

            $validator = $this->get('validator');
            $errors = $validator->validate($ptasznik);

            if (count($errors) > 0) {
                $this->addFlash(
                        'notice', 'Proszę wypełnić wymagane pola!'
                );
                return $this->redirectToRoute('addPtasznik');
            }

            $em->persist($ptasznik);
            $em->flush();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->addFlash(
                        'notice', 'Ptasznik o podanym kodzie EAN (' + $p['kodEan'] + ') już istnieje!'
                );
                return $this->redirectToRoute('addPtasznik');
            }
        }

        $this->addFlash(
                'notice', 'Dodano ptasznika!'
        );
        return $this->redirectToRoute('showPtaszniki');
    }

}
