<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SecurityController
 *
 * @author Mateusz Błaszczak
 */
class SecurityController extends Controller {

    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');

        // pobranie błędu logowania, jeśli sie taki pojawił
        $error = $authenticationUtils->getLastAuthenticationError();

        // nazwa użytkownika ostatnio wprowadzona przez aktualnego użytkownika
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'AppBundle:security:login.html.twig', array(
                    // nazwa użytkownika ostatnio wprowadzona przez aktualnego użytkownika
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction() {
        // ta akcja nie będzie wykonywana,
        // ponieważ trasa jest wykorzystywana przez system bezpieczeństwa
    }

}
