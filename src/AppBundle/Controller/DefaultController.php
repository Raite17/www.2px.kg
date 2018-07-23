<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movies;
use AppBundle\Entity\Screenshots;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Twig_Extension;

class VarsExtension extends Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'some.extension';
    }

    public function getFilters() {
        return array(
            'json_decode'   => new \Twig_Filter_Method($this, 'jsonDecode'),
        );
    }

    public function jsonDecode($str) {
        return json_decode($str);
    }
}

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $today = $em->getRepository('AppBundle:Movies')->findBy(array(),  array('premier' => 'ASC'),10);
        $soon = $em->getRepository('AppBundle:Movies')->findBy(array(), array('premier' => 'DESC'),5);
        $slider = $em->getRepository('AppBundle:Movies')->findBy(array('id' => [6,7,9,10,13,17]));
        $soon = array_reverse($soon);

        return $this->render('default/index.html.twig', array(
            'movies' => $today,
            'soon_movies' => $soon,
            'slide' => $slider,
        ));
    }


    /**
     * @Route("/", name="contact_page")
     */
    public function ContactAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/contacts.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/", name="sign_in")
     */
    public function LoginAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/sign_in.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/", name="sign_up")
     */
    public function RegisterAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/sign_up.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/", name="movie_info")
     */
    public function Movie_info_Action(Movies $movie)
    {
        return $this->render('default/movie_info.html.twig', array(
            'movie' => $movie,
            'screenshots' => json_decode($movie -> getScreenshots())
        ));
    }

    /**
     * @Route("/", name="book_tickets")
     */
    public function Book_Tickets_Action(Movies $movie)
    {
        return $this->render('default/book_tickets.html.twig', array(
            'movie' => $movie,
        ));
    }

    public function trailerAction($name)
    {
        $webPath ='assets/trailer/' . $name . '.mp4';
        $response = new BinaryFileResponse($webPath);
        $response->setAutoEtag(true);
        $response->headers->set('Content-Type', 'video/mp4');
        return $response;
    }
}
