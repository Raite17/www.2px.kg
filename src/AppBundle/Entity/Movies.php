<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Movies
 *
 * @ORM\Table(name="movies")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoviesRepository")
 */
class Movies
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=255)
     */
    private $poster;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;


    /**
     * @var string
     *
     * @ORM\Column(name="slider", type="string", length=255)
     */
    private $slider;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="premier", type="date")
     */
    private $premier;


    /**
     * @var string
     *
     * @ORM\Column(name="actors", type="text")
     */
    private $actors;

    /**
     * @var string
     *
     * @ORM\Column(name="director", type="text")
     */
    private $director;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="screenshots", type="text")
     */
    private $screenshots;

    /**
     * @var string
     *
     * @ORM\Column(name="trailer", type="text")
     */
    private $trailer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Movies
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set poster
     *
     * @param string $poster
     *
     * @return Movies
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Movies
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }


    /**
     * Set slider
     *
     * @param string $slider
     *
     * @return Movies
     */
    public function setSlider($slider)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * Get slider
     *
     * @return string
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * Set premier
     *
     * @param Date $premier
     *
     * @return Movies
     */
    public function setPremier($premier)
    {
        $this->premier = $premier;

        return $this;
    }

    /**
     * Get premier
     *
     * @return \DateTime
     */
    public function getPremier()
    {
        return $this->premier;
    }
    /**
     * Set country
     *
     * @param string $country
     *
     * @return Movies
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set screenshots
     *
     * @param string $screenshots
     *
     * @return Movies
     */
    public function setScreenshots($screenshots)
    {
        $this->screenshots = $screenshots;

        return $this;
    }

    /**
     * Get  screenshots
     *
     * @return string
     */
    public function getScreenshots()
    {
        return $this->screenshots;
    }

    /**
     * Set actors
     *
     * @param string $actors
     *
     * @return Movies
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }

    /**
     * Get actors
     *
     * @return string
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Set director
     *
     * @param string $director
     *
     * @return Movies
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Movies
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set trailer
     *
     * @param string $trailer
     *
     * @return Movies
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;

        return $this;
    }

    /**
     * Get trailer
     *
     * @return string
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Movies
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}

