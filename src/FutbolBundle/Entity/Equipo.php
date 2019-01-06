<?php

namespace FutbolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo")
 * @ORM\Entity(repositoryClass="FutbolBundle\Repository\EquipoRepository")
 */
class Equipo
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255)
     */
    private $categoria;
    
     /**
     * @ORM\ManyToMany(targetEntity="Entrenador", inversedBy="equipos")
     */
    private $entrenadores;


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
     * @return Equipo
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
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Equipo
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entrenadores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entrenadore
     *
     * @param \FutbolBundle\Entity\Entrenador $entrenadore
     *
     * @return Equipo
     */
    public function addEntrenadore(\FutbolBundle\Entity\Entrenador $entrenadore)
    {
        $this->entrenadores[] = $entrenadore;

        return $this;
    }

    /**
     * Remove entrenadore
     *
     * @param \FutbolBundle\Entity\Entrenador $entrenadore
     */
    public function removeEntrenadore(\FutbolBundle\Entity\Entrenador $entrenadore)
    {
        $this->entrenadores->removeElement($entrenadore);
    }

    /**
     * Get entrenadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntrenadores()
    {
        return $this->entrenadores;
    }
    
    public function __toString(){

        return $this->nombre;
    }
}
