<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/")
 * Class SecretController
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="admin_login")
     */
    public function loginAction(Request $request)
    {
        $error = $this->get('security.authentication_utils')->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $this->get('security.authentication_utils')->getLastUsername();

        return $this->render('@Admin/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="admin_logout")
     */
    public function logoutAction(Request $request)
    {
    }
}