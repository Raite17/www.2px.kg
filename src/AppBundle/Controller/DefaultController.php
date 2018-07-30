<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movies;
use AppBundle\Entity\Orders;
use AppBundle\Entity\Screenshots;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Twig_Extension;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $today = $em->getRepository('AppBundle:Movies')->findBy(array(),  array('premier' => 'ASC'),11);
        $soon = $em->getRepository('AppBundle:Movies')->findBy(array(), array('premier' => 'DESC'),5);
        $slider = $em->getRepository('AppBundle:Movies')->findBy(array('id' => [6,7,9,10,11,13,17]));
        $soon = array_reverse($soon);

        return $this->render('default/index.html.twig', array(
            'movies' => $today,
            'soon_movies' => $soon,
            'slide' => $slider,
        ));
    }

    /**
     * @Route("/", name="order_new")
     */
    public function orderAction(Request $request){
        $order = new Orders();
        $movie_title = $request->request->get('movie_name');
        $time = $request->request->get('time');
        $hall = $request->request->get('hall');
        $seats = $request->request->get('seats');

//        print_r($request->request->all());

        if (!$movie_title || !$time || !$hall || !$seats )
        {
            $error = json_encode(array('status' => false,'message' => 'No data'));
            return new Response($error);
        }

        else
        {
            $em = $this->getDoctrine()->getManager();
            $order->setMovieTitle($movie_title);
            $order->setOrderTime($time);
            $order->setHall($hall);
            $order->setOrderSeat(json_encode($seats));
            $em->persist($order);
            $em->flush();
            $succes = json_encode(array('status' => true,'message' => 'Success'));
            return new Response($succes);
        }
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
     * @Route("/", name="user_page")
     */

    public function User_Page_Action()
    {
        $em = $this->getDoctrine()->getManager();

        $orders = $em->getRepository('AppBundle:Orders')->findAll();

        return $this->render('default/user_page.html.twig', array(
            'ticket' => $orders,
        ));
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
