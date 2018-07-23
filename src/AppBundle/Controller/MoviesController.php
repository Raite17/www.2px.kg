<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movies;
use AppBundle\Form\MoviesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Movie controller.
 *
 */
class MoviesController extends Controller
{
    /**
     * Lists all movie entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $movies = $em->getRepository('AppBundle:Movies')->findAll();

        return $this->render('movies/index.html.twig', array(
            'movies' => $movies,
        ));
    }

    /**
     * Creates a new movie entity.
     *
     */
    public function newAction(Request $request)
    {
        $movie = new Movies();
        $form = $this->createForm('AppBundle\Form\MoviesType', $movie);
        $upload = $this->createForm(MoviesType::class,$movie);
        $form->handleRequest($request);
        $upload->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $upload->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $em = $this->getDoctrine()->getManager();
            $file = $movie->getPoster();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory' ),$fileName
            );
            $movie->setPoster($fileName);
            $em->persist($movie);
            $em->flush();
            return $this->redirectToRoute('movies_show', array('id' => $movie->getId()));
        }

        return $this->render('movies/new.html.twig', array(
            'movie' => $movie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a movie entity.
     *
     */
    public function showAction(Movies $movie)
    {
        $deleteForm = $this->createDeleteForm($movie);

        return $this->render('movies/show.html.twig', array(
            'movie' => $movie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing movie entity.
     *
     */
    public function editAction(Request $request, Movies $movie)
    {
        $deleteForm = $this->createDeleteForm($movie);
        $editForm = $this->createForm('AppBundle\Form\MoviesType', $movie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file = $movie->getPoster();
            $screens = $movie->getScreenshots();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory' ),$fileName
            );
            if(!is_array($screens)) {
                $screens = array($screens);
            }
            $screen_arr = array();
            foreach ($screens as $screen){
                $screen_name = md5(uniqid()).'.'.$screen->guessExtension();
                $screen->move(
                    $this->getParameter('upload_directory' ),$screen_name
                );
                $screen_arr[] = $screen_name;
            }
            $movie->setScreenshots(json_encode($screen_arr));
            $movie->setPoster($fileName);
            $this->getDoctrine()->getManager()->flush();
          return $this->redirectToRoute('movies_edit', array('id' => $movie->getId()));
        }

        return $this->render('movies/edit.html.twig', array(
            'movie' => $movie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a movie entity.
     *
     */
    public function deleteAction(Request $request, Movies $movie)
    {
        $form = $this->createDeleteForm($movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('movies_index');
    }

    /**
     * Creates a form to delete a movie entity.
     *
     * @param Movies $movie The movie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Movies $movie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('movies_delete', array('id' => $movie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

if (!function_exists('print_die')) {
    function print_die($variable)
    {
        $type = gettype($variable);
        $styles =
            'outline: 1px solid black;
             background: black;
             padding: 10px;';
        $color = '';
        switch ($type)
        {
            case 'array':
                $color = 'white';
                break;
            case 'integer':
                $color = 'cyan';
                break;
            case 'string':
                $color = 'lime';
                break;
            default:
                $color = 'coral';
                break;
        }
        $styles .= 'color:' . $color . ';border: 2px solid ;' . $color . ';';
        echo '<pre style="' . $styles . '">';
        print_r($variable);
        echo '</pre><br>';
        die;
    }
}
