<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @ORM\Column(name="movie_title", type="string", length=255)
     */
    private $movieTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="order_time", type="string", length=255)
     */
    private $orderTime;

    /**
     * @var string
     *
     * @ORM\Column(name="hall", type="string", length=255)
     */
    private $hall;

    /**
     * @var string
     *
     * @ORM\Column(name="order_seat", type="text")
     */
    private $orderSeat;


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
     * Set movieTitle
     *
     * @param string $movieTitle
     *
     * @return Orders
     */
    public function setMovieTitle($movieTitle)
    {
        $this->movieTitle = $movieTitle;

        return $this;
    }

    /**
     * Get movieTitle
     *
     * @return string
     */
    public function getMovieTitle()
    {
        return $this->movieTitle;
    }

    /**
     * Set orderTime
     *
     * @param string $orderTime
     *
     * @return Orders
     */
    public function setOrderTime($orderTime)
    {
        $this->orderTime = $orderTime;

        return $this;
    }

    /**
     * Get orderTime
     *
     * @return string
     */
    public function getOrderTime()
    {
        return $this->orderTime;
    }

    /**
     * Set hall
     *
     * @param string $hall
     *
     * @return Orders
     */
    public function setHall($hall)
    {
        $this->hall = $hall;

        return $this;
    }

    /**
     * Get hall
     *
     * @return string
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * Set orderSeat
     *
     * @param string $orderSeat
     *
     * @return Orders
     */
    public function setOrderSeat($orderSeat)
    {
        $this->orderSeat = $orderSeat;

        return $this;
    }

    /**
     * Get orderSeat
     *
     * @return string
     */
    public function getOrderSeat()
    {
        return $this->orderSeat;
    }
}

