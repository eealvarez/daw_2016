<?php

namespace FutbolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrenador
 *
 * @ORM\Table(name="entrenador")
 * @ORM\Entity(repositoryClass="FutbolBundle\Repository\EntrenadorRepository")
 */
class Entrenador
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
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Equipo", inversedBy="entrenadores")
     */
    private $equipos;


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
     * @return Entrenador
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Entrenador
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add equipo
     *
     * @param \FutbolBundle\Entity\Equipo $equipo
     *
     * @return Entrenador
     */
    public function addEquipo(\FutbolBundle\Entity\Equipo $equipo)
    {
        $this->equipos[] = $equipo;

        return $this;
    }

    /**
     * Remove equipo
     *
     * @param \FutbolBundle\Entity\Equipo $equipo
     */
    public function removeEquipo(\FutbolBundle\Entity\Equipo $equipo)
    {
        $this->equipos->removeElement($equipo);
    }

    /**
     * Get equipos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipos()
    {
        return $this->equipos;
    }
    
    public function __toString(){       //esto es para evitar el error al quere ingresar un nuevo equipo porque no sabe qué estrenador seleccionar de la lista porque no puede convertir a tipo String el objeto entrenador

        return $this->nombre;
    }

}
