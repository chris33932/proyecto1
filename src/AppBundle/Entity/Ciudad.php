<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CiudadRepository")
 */
class Ciudad
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;


    /**
     * @ORM\OneToMany(targetEntity="Tienda", mappedBy="ciudad")
     */
      protected $tiendas;





      /**
        * @ORM\OneToMany(targetEntity="Oferta", mappedBy="ciudad")
        */
       protected $ofertas;









     public function __toString()
      {
          return $this->getNombre();
      }

      public function __construct()
         {
             $this->tiendas = new \Doctrine\Common\Collections\ArrayCollection();
             $this->ofertas = new \Doctrine\Common\Collections\ArrayCollection();

         }








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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Ciudad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Ciudad
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add tienda
     *
     * @param \AppBundle\Entity\Tienda $tienda
     *
     * @return Ciudad
     */
    public function addTienda(\AppBundle\Entity\Tienda $tienda)
    {
        $this->tiendas[] = $tienda;

        return $this;
    }

    /**
     * Remove tienda
     *
     * @param \AppBundle\Entity\Tienda $tienda
     */
    public function removeTienda(\AppBundle\Entity\Tienda $tienda)
    {
        $this->tiendas->removeElement($tienda);
    }

    /**
     * Get tiendas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTiendas()
    {
        return $this->tiendas;
    }

    /**
     * Add oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     *
     * @return Ciudad
     */
    public function addOferta(\AppBundle\Entity\Oferta $oferta)
    {
        $this->ofertas[] = $oferta;

        return $this;
    }

    /**
     * Remove oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     */
    public function removeOferta(\AppBundle\Entity\Oferta $oferta)
    {
        $this->ofertas->removeElement($oferta);
    }

    /**
     * Get ofertas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfertas()
    {
        return $this->ofertas;
    }
}
