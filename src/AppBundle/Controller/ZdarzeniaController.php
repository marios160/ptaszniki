<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Zdarzenie;
use Symfony\Component\Config\Definition\Exception\Exception;

class ZdarzeniaController extends Controller {

    /**
     * @Route("/zdarzenia/{currentPage}", defaults={"currentPage" = 1}, 
     *  name="showZdarzenia", requirements={"currentPage": "\d+"})
     */
    public function showAction(Request $request, $currentPage) {
        $session = $request->getSession();
        if ($request->get('find') != "") {
            $session->set('find', $request->get('find'));
        } else {
            $session->set('find', "");
        }
        $limit = 30;
        $em = $this->getDoctrine()->getManager();
        $zdarzenia = $em->getRepository('AppBundle:Zdarzenie')->findBySession($session, $currentPage, $limit);

        $maxPages = ceil($zdarzenia->count() / $limit);
        $thisPage = $currentPage;

        return $this->render('@App/Zdarzenia/show.html.twig', array(
                    'zdarzenia' => $zdarzenia,
                    'maxPages' => $maxPages,
                    'thisPage' => $thisPage
        ));
        //return $this->render('@App/Zdarzenia/show.html.twig', array('zdarzenia' => $zdarzenia));
    }

    /**
     * @Route("/zdarzenia/czynnosc", name="czynnoscZdarzenie")
     */
    public function czynnoscAction(Request $request) {
        $request->get('chck');
        switch ($request->get('czynnosc')) {
            case 'deleteZdarzenie':
                if (empty($request->get('chck')) == false) {
                    return $this->redirect($this->generateUrl('deleteZdarzenie', array('chck' => $request->get('chck'))));
                } else {
                    $this->addFlash(
                            'notice', 'Proszę zaznaczyć pozycję!'
                    );
                    return $this->redirectToRoute('showZdarzenia');
                }
            case 'addZdarzenie':
                return $this->redirect($this->generateUrl('addZdarzenie'));
            case 'addMultiZdarzenie':
                return $this->redirect($this->generateUrl('addMultiZdarzenie'));
            case 'editZdarzenie':
                if (empty($request->get('chck')) == false) {
                    return $this->redirect($this->generateUrl('editZdarzenie', array('chck' => $request->get('chck'))));
                } else {
                    $this->addFlash(
                            'notice', 'Proszę zaznaczyć pozycję!'
                    );
                    return $this->redirectToRoute('showZdarzenia');
                }
        }
        //while($request->get('chck'))
        // $request->get('chck')
    }

//##########################################################################################
//                  Przenoszenie do formularzy / pierwsza akcja
//##########################################################################################

    /**
     * @Route("/zdarzenia/delete", name="deleteZdarzenie")
     */
    public function deleteAction(Request $request) {
        foreach ($request->get('chck') as $chck) {
            $em = $this->getDoctrine()->getManager();
            $zdarzenie = $em->getReference('AppBundle:Zdarzenie', $chck);
            $em->remove($zdarzenie);
            $em->flush();
        }
        $this->addFlash(
                'notice', 'Usunięto wybrane rekordy!'
        );
        return $this->redirectToRoute('showZdarzenia');
    }

    /**
     * @Route("/zdarzenia/add", name="addZdarzenie")
     */
    public function addAction(Request $request) {
        $typZdarzenia = $this->getDoctrine()->
                        getRepository('AppBundle:TypZdarzenia')->findAll();
        $pracownik = $this->getDoctrine()->
                        getRepository('AppBundle:Pracownik')->findAll();
        $magazyn = $this->getDoctrine()->
                        getRepository('AppBundle:Magazyn')->findAll();
        $karma = $this->getDoctrine()->
                        getRepository('AppBundle:Karma')->findAll();
        $terrarium = $this->getDoctrine()->
                        getRepository('AppBundle:Terrarium')->findAll();
        $count = 1;
        if (!empty($request->get('ptasznik'))) {
            $count = 1;
        }
        return $this->render('@App/Zdarzenia/add.html.twig', array(
                    'typZdarzenia' => $typZdarzenia,
                    'pracownicy' => $pracownik,
                    'magazyny' => $magazyn,
                    'karmy' => $karma,
                    'ptasznik' => $request->get('ptasznik'),
                    'terraria' => $terrarium,
                    'count' => $count));
    }

//    /**
//     * @Route("/zdarzenia/edit", name="editZdarzenie")
//     */
//    public function editAction(Request $request) {
//        $zdarzenia = $this->getDoctrine()->
//                        getRepository('AppBundle:Zdarzenie')->findByIds($request->get('chck'));
//        $typZdarzenia = $this->getDoctrine()->
//                        getRepository('AppBundle:TypZdarzenia')->findAll();
//        $pracownik = $this->getDoctrine()->
//                        getRepository('AppBundle:Pracownik')->findAll();
//        return $this->render('@App/Zdarzenia/edit.html.twig', array('zdarzenia' => $zdarzenia,
//                    'typZdarzenia' => $typZdarzenia,
//                    'pracownicy' => $pracownik,
//                    'ptasznik' => $request->get('ptasznik')));
//    }

    /**
     * @Route("/zdarzenia/addMulti", name="addMultiZdarzenie")
     */
    public function addMultiAction(Request $request) {
        $typZdarzenia = $this->getDoctrine()->
                        getRepository('AppBundle:TypZdarzenia')->findAll();
        $pracownik = $this->getDoctrine()->
                        getRepository('AppBundle:Pracownik')->findAll();
        $magazyn = $this->getDoctrine()->
                        getRepository('AppBundle:Magazyn')->findAll();
        $karma = $this->getDoctrine()->
                        getRepository('AppBundle:Karma')->findAll();
        $terrarium = $this->getDoctrine()->
                        getRepository('AppBundle:Terrarium')->findAll();
        return $this->render('@App/Zdarzenia/addMulti.html.twig', array(
                    'typZdarzenia' => $typZdarzenia,
                    'pracownicy' => $pracownik,
                    'ptasznik' => $request->get('ptasznik'),
                    'ptasznik1' => $request->get('ptasznik1'),
                    'ptasznik2' => $request->get('ptasznik2'),
                    'magazyny' => $magazyn,
                    'karmy' => $karma,
                    'terraria' => $terrarium
        ));
    }

    /**
     * @Route("/zdarzenia/addMultiArea", name="addMultiAreaZdarzenie")
     */
    public function addMultiAreaAction(Request $request) {
        $typZdarzenia = $this->getDoctrine()->
                        getRepository('AppBundle:TypZdarzenia')->findAll();
        $pracownik = $this->getDoctrine()->
                        getRepository('AppBundle:Pracownik')->findAll();
        $magazyn = $this->getDoctrine()->
                        getRepository('AppBundle:Magazyn')->findAll();
        $karma = $this->getDoctrine()->
                        getRepository('AppBundle:Karma')->findAll();
        $terrarium = $this->getDoctrine()->
                        getRepository('AppBundle:Terrarium')->findAll();
        return $this->render('@App/Zdarzenia/addMultiArea.html.twig', array(
                    'typZdarzenia' => $typZdarzenia,
                    'pracownicy' => $pracownik,
                    'ptasznik' => $request->get('ptasznik'),
                    'ptaszniki' => $request->get('ptaszniki'),
                    'magazyny' => $magazyn,
                    'karmy' => $karma,
                    'terraria' => $terrarium
        ));
    }

//##########################################################################################
//                  Zapisanie danych / druga akcja
//##########################################################################################
//    /**
//     * @Route("/zdarzenia/editZapisz", name="editZapiszZdarzenie")
//     */
//    public function editZapiszAction(Request $request) {
//        //echo$request->get('zdarzenia') ;
//        foreach ($request->get('zdarzeniaEdit') as $p) {
//            $em = $this->getDoctrine()->getManager();
//            $zdarzenie = $em->getRepository('AppBundle:Zdarzenie')->find($p['id']);
//            $typZdarzenia = $em->getRepository('AppBundle:TypZdarzenia')->find($p['typZdarzenia']);
//            $pracownik = $em->getRepository('AppBundle:Pracownik')->find($p['pracownik']);
//            $ptasznik = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($p['ptasznik'])[0];
//            if (!$ptasznik) {
//                throw $this->createNotFoundException(
//                        'No ptasznik found for ean ' . $p['ptasznik']
//                );
//            }
//            $zdarzenie->setTypZdarzenia($typZdarzenia);
//            $zdarzenie->setPracownik($pracownik);
//            $zdarzenie->setPtasznik($ptasznik[0]);
//            $zdarzenie->setData(new \Datetime($p['data']));
//            $zdarzenie->setOpis($p['opis']);
//            $em->flush();
//        }
//        $this->addFlash(
//                'notice', 'Zapisano zmiany!'
//        );
//        return $this->redirectToRoute('showZdarzenia');
//    }

    /**
     * @Route("/zdarzenia/addZapisz", name="addZapiszZdarzenie")
     */
    public function addZapiszAction(Request $request) {
        //echo$request->get('zdarzenia') ;

        $p = $request->get('zdarzenie');
        try {
            if (empty($p['typZdarzenia']) || empty($p['pracownik']) || empty($p['ptasznik']) || empty($p['info'])) {
                throw new Exception('Nie wypełniono wymaganych pól', 21);
            }
            $em = $this->getDoctrine()->getManager();
            $typZdarzenia = $em->getRepository('AppBundle:TypZdarzenia')->find($p['typZdarzenia']);
            $pracownik = $em->getRepository('AppBundle:Pracownik')->find($p['pracownik']);

            $pt = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($p['ptasznik'])[0];
            if (!$pt) {
                throw new Exception('Ptasznik nie istnieje', 22);
            }
            $zdarzenie = new Zdarzenie();
            $zdarzenie->setTypZdarzenia($typZdarzenia);
            $zdarzenie->setPracownik($pracownik);
            $zdarzenie->setPtasznik($pt);
            $zdarzenie->setData(new \Datetime($p['data']));
            $zdarzenie->setOpis($p['opis']);
            $zdarzenie->setRozmiar("");
            $zdarzenie = self::wykonajZdarzenie($p, $zdarzenie, $pt, $em);
            $em->persist($zdarzenie);
            $em->flush();
        } catch (Exception $e) {
            if ($e->getCode() == 22) {
                $this->addFlash('notice', 'Ptasznik o podanym kodzie EAN (' . $p['ptasznik'] . ') nie istnieje!');
            } else
            if ($e->getCode() == 21) {
                $this->addFlash('notice', 'Nie wypełniono wymaganych pól!');
            } else {
                $this->addFlash('notice', $e->getMessage() . "\n\n" . $e->getLine());
            }
            return $this->redirectToRoute('addZdarzenie', array('ptasznik' => $p['ptasznik']));
        }

        $this->addFlash(
                'notice', 'Dodano zdarzenie!'
        );
        return $this->redirectToRoute('showZdarzenia');
    }

    /**
     * @Route("/zdarzenia/addMultiZapisz", name="addMultiZapiszZdarzenie")
     */
    public function addMultiZapiszAction(Request $request) {
        //echo$request->get('zdarzenia') ;


        $p = $request->get('zdarzenie');
        try {
            if (empty($p['typZdarzenia']) || empty($p['pracownik']) || empty($p['ptasznik1']) || empty($p['ptasznik2'])) {
                throw new Exception('Nie wypełniono wymaganych pól', 21);
            }
            if ($p['ptasznik1'] == $p['ptasznik2']) {
                throw new Exception('Jeden ptasznik', 23);
            }
            $em = $this->getDoctrine()->getManager();
            $pt = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($p['ptasznik1'])[0];
            if (!$pt) {
                throw new Exception('Ptasznik nie istnieje', 31);
            }
            $pt = $em->getRepository('AppBundle:Ptasznik')->findByKodEan($p['ptasznik2'])[0];
            if (!$pt) {
                throw new Exception('Ptasznik nie istnieje', 32);
            }


            $typZdarzenia = $em->getRepository('AppBundle:TypZdarzenia')->find($p['typZdarzenia']);
            $pracownik = $em->getRepository('AppBundle:Pracownik')->find($p['pracownik']);
            $ptasznik = $em->getRepository('AppBundle:Ptasznik')->findByKodEanRange($p['ptasznik1'], $p['ptasznik2']);
            if (!$ptasznik) {
                throw new Exception('Niepoprawny zakres kodów EAN', 24);
            }

            foreach ($ptasznik as $el) {
                $zdarzenie = new Zdarzenie();
                $zdarzenie->setTypZdarzenia($typZdarzenia);
                $zdarzenie->setPracownik($pracownik);
                $zdarzenie->setPtasznik($el);
                $zdarzenie->setData(new \Datetime($p['data']));
                $zdarzenie->setOpis($p['opis']);
                $zdarzenie->setRozmiar("");
                $zdarzenie = self::wykonajZdarzenie($p, $zdarzenie, $el, $em);
                $em->persist($zdarzenie);
            }
            $em->flush();
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case 22:
                    $this->addFlash('notice', 'Ptasznik o podanym kodzie EAN (' . $p['ptasznik'] . ') nie istnieje!');
                    break;
                case 31:
                    $this->addFlash('notice', 'Ptasznik o podanym kodzie EAN (' . $p['ptasznik1'] . ') nie istnieje!');
                    break;
                case 32:
                    $this->addFlash('notice', 'Ptasznik o podanym kodzie EAN (' . $p['ptasznik2'] . ') nie istnieje!');
                    break;
                case 21:
                    $this->addFlash('notice', 'Nie wypełniono wymaganych pól!');
                    break;
                case 23:
                    $this->addFlash('notice', 'Jeśli chcesz dodać zdarzenie dla jednego ptasznika, użyj opcji "Dodaj zdarzenie"');
                    return $this->redirectToRoute('showZdarzenia');
                    break;
                case 24:
                    $this->addFlash('notice', 'Niepoprawny zakres kodów EAN!');
                    return $this->redirectToRoute('addMultiZdarzenie');
                    break;
                default:
                    $this->addFlash('notice', $e->getMessage() . "\n\n" . $e->getLine());
                    break;
            }
            return $this->redirectToRoute('addMultiZdarzenie', array('ptasznik1' => $p['ptasznik1'], 'ptasznik2' => $p['ptasznik2']));
        }

        $this->addFlash(
                'notice', 'Dodano Zdarzenie!'
        );
        return $this->redirectToRoute('showZdarzenia');
    }

    /**
     * @Route("/zdarzenia/addMultiAreaZapisz", name="addMultiAreaZapiszZdarzenie")
     */
    public function addMultiAreaZapiszAction(Request $request) {
        //echo$request->get('zdarzenia') ;

        $p = $request->get('zdarzenie');
        try {
            if (empty($p['typZdarzenia']) || empty($p['pracownik']) || empty($p['ptaszniki'])) {
                throw new Exception('Nie wypełniono wymaganych pól', 21);
            }
            $em = $this->getDoctrine()->getManager();
            $typZdarzenia = $em->getRepository('AppBundle:TypZdarzenia')->find($p['typZdarzenia']);
            $pracownik = $em->getRepository('AppBundle:Pracownik')->find($p['pracownik']);
            $ptasznik = explode(PHP_EOL, $p['ptaszniki']);

            foreach ($ptasznik as $el) {

                $pt = $em->getRepository('AppBundle:Ptasznik')->findByKodEan(trim($el))[0];
                if (!$pt) {
                    throw new Exception('Ptasznik nie istnieje', 33);
                }
                $zdarzenie = new Zdarzenie();
                $zdarzenie->setTypZdarzenia($typZdarzenia);
                $zdarzenie->setPracownik($pracownik);
                $zdarzenie->setPtasznik($pt);
                $zdarzenie->setData(new \Datetime($p['data']));
                $zdarzenie->setOpis($p['opis']);
                $zdarzenie->setRozmiar("");
                $zdarzenie = self::wykonajZdarzenie($p, $zdarzenie, $pt, $em);
                $em->persist($zdarzenie);
            }
            $em->flush();
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case 22:
                    $this->addFlash('notice', 'Ptasznik o podanym kodzie EAN (' . $p['ptasznik'] . ') nie istnieje!');
                    break;
                case 33:
                    $this->addFlash('notice', 'Jeden z podanych ptaszników o danym kodzie EAN nie istnieje!');
                    break;
                case 21:
                    $this->addFlash('notice', 'Nie wypełniono wymaganych pól!');
                    break;
                default:
                    $this->addFlash('notice', $e->getMessage() . "\n\n" . $e->getLine());
                    break;
            }
            return $this->redirectToRoute('addMultiAreaZdarzenie', array('ptaszniki' => $p['ptaszniki']));
        }
        $this->addFlash(
                'notice', 'Dodano Zdarzenie!'
        );
        return $this->redirectToRoute('showZdarzenia');
    }

    public static function wykonajZdarzenie($p, $zdarzenie, $pt, $em) {
        switch ($p['typZdarzenia']) {
            case '1':
                $karma = $em->getRepository('AppBundle:Karma')->find($p['info']);
                $zdarzenie->setKarma($karma);
                break;
            case '2':
                $zdarzenie->setRozmiar($p['info']);
                $pt->setAktualnyRozmiar($p['info']);
                break;
            case '3':
                $magazyn = $em->getRepository('AppBundle:Magazyn')->find($p['info']);
                $zdarzenie->setMagazyn($magazyn);
                $pt->setMagazyn($magazyn);
                break;
            case '4':
                $pt->setAktualnyRozmiar("L1");
                break;
            case '5':
                $pt->setUwagi("---ZDECHŁ---\n" . $pt->getUwagi());
                break;
            case '6':
                $terrarium = $em->getRepository('AppBundle:Terrarium')->find($p['info']);
                $zdarzenie->setTerrarium($terrarium);
                $pt->setTerrarium($terrarium);
                break;

            default:
                break;
        }
        return $zdarzenie;
    }

}
