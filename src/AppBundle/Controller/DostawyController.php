<?php



namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\DostawaType;
use AppBundle\Entity\Dostawa;
/**
 * Description of DostawyController
 *
 * @author Mateusz Błaszczak
 */
class DostawyController extends Controller{
    /**
     * @Route("/dostawy", name="showDostawy")
     */
    public function showAction() {
        $dostawy = $this->getDoctrine()->getRepository('AppBundle:Dostawa')->findAll();

        return $this->render('@App/Dostawy/show.html.twig', array('dostawy' => $dostawy));
    }

    /**
     * @Route("/dostawy/add", name="addDostawa")
     */
    public function addAction(Request $request) {
        $dostawa = new Dostawa();
        $form = $this->createForm(DostawaType::class, $dostawa);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dostawa);
            $em->flush();
            $this->addFlash(
                    'notice', 'Dodano dostawę!'
            );
            return $this->redirectToRoute('showDostawy');
        }

        return $this->render('@App/Dostawy/add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/dostawy/delete", name="deleteDostawa")
     */
    public function deleteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $dostawa = $em->getReference('AppBundle:Dostawa', $request->get('id'));
        $em->remove($dostawa);
        $em->flush();
        $this->addFlash(
                'notice', 'Usunięto dostawę!'
        );
        return $this->redirectToRoute('showDostawy');
    }

    /**
     * @Route("/dostawy/edit", name="editDostawa")
     */
    public function editAction(Request $request) {
        $dostawa = $this->getDoctrine()->getRepository('AppBundle:Dostawa')->find($request->get('id'));
        $form = $this->createForm(DostawaType::class, $dostawa);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dostawa);
            $em->flush();
            $this->addFlash(
                    'notice', 'Zapisano zmiany!'
            );
            return $this->redirectToRoute('showDostawy');
        }

        return $this->render('@App/Dostawy/edit.html.twig', array('form' => $form->createView()));
    }
}
