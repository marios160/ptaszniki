<?php



namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\KarmaType;
use AppBundle\Entity\Karma;
/**
 * Description of KarmyController
 *
 * @author Mateusz Błaszczak
 */
class KarmyController extends Controller{
    /**
     * @Route("/karmy", name="showKarmy")
     */
    public function showAction() {
        $karmy = $this->getDoctrine()->getRepository('AppBundle:Karma')->findAll();

        return $this->render('@App/Karmy/show.html.twig', array('karmy' => $karmy));
    }

    /**
     * @Route("/karmy/add", name="addKarma")
     */
    public function addAction(Request $request) {
        $karma = new Karma();
        $form = $this->createForm(KarmaType::class, $karma);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($karma);
            $em->flush();
            $this->addFlash(
                    'notice', 'Dodano karmę!'
            );
            return $this->redirectToRoute('showKarmy');
        }

        return $this->render('@App/Karmy/add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/karmy/delete", name="deleteKarma")
     */
    public function deleteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $karma = $em->getReference('AppBundle:Karma', $request->get('id'));
        $em->remove($karma);
        $em->flush();
        $this->addFlash(
                'notice', 'Usunięto Karmę!'
        );
        return $this->redirectToRoute('showKarmy');
    }

    /**
     * @Route("/karmy/edit", name="editKarma")
     */
    public function editAction(Request $request) {
        $karma = $this->getDoctrine()->getRepository('AppBundle:Karma')->find($request->get('id'));
        $form = $this->createForm(KarmaType::class, $karma);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($karma);
            $em->flush();
            $this->addFlash(
                    'notice', 'Zapisano zmiany!'
            );
            return $this->redirectToRoute('showKarmy');
        }

        return $this->render('@App/Karmy/edit.html.twig', array('form' => $form->createView()));
    }
}
