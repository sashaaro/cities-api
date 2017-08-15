<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\CityType;
use AppBundle\Entity\City;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/")
 * @package AdminBundle\Controller
 */
class MainController extends Controller
{
    /**
     * @Route(path="/", name="admin_index")
     */
    public function actionIndex(Request $request)
    {
        /** @var City[] $cities */
        $cities = $this->getDoctrine()->getRepository(City::class)->findBy([], ['id' => 'ASC']);
        return $this->render('@Admin/index.html.twig', [
            'cities' => $cities
        ]);
    }

    /**
     * @Route(path="/cities/new", name="admin_cities_new")
     */
    public function newIndex(Request $request)
    {
        $form = $this->createForm(CityType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('@Admin/cities/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/cities/edit/{id}", name="admin_cities_edit")
     * @ParamConverter(class="AppBundle\Entity\City")
     */
    public function editIndex(Request $request, City $city)
    {
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('@Admin/cities/edit.html.twig', [
            'form' => $form->createView(),
            'city' => $city
        ]);
    }
}