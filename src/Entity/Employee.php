<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 *  @UniqueEntity(
 *     fields={"full_name", "card_id", "phone" , "social_security"},
 *     message="Ya se ha registrado este campo."
 * )
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

     /**
     * @ORM\Column(type="string", length=200)
    */

    private $full_name;

    /**
     * @ORM\Column(type="string", length=20)
    */

    private $card_id;

    /**
     * @ORM\Column(type="text", length=200)
    */

    private $address;

    /**
     * @ORM\Column(type="text", length=50)
    */

    private $phone;

    /**
     * @ORM\Column(type="text" ,length=200)
    */

    private $province;

    /**
     * @ORM\Column(type="integer")
    */

    private $zip_code;

    //  /**
    //  * @ORM\Column(type="integer")
    // */

    // private $nif;

    /**
     * @ORM\Column(type="integer")
    */

    private $social_security;

    /**
     * @ORM\Column(type="date")
    */

    private $date_start;

    /**
     * @ORM\Column(type="text", length=200)
    */

    private $tipo_empleado;
    
    /**
     * @ORM\Column(type="integer" ,length=1, nullable=true)
     * 
     */
    
    private $state;

    //Getters & Setters
    public function getFullName()
    {
        return $this->full_name;
    }

    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getCardID()
    {
        return $this->card_id;
    }

    public function setCardID($card_id)
    {
        $this->card_id = $card_id;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getDateStart()
    {
        return $this->date_start;
    }

    public function setDateStart($date_start) {
        $this->date_start = $date_start;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function setProvince($province)
    {
        $this->province = $province;
    }

    // public function getNif()
    // {
    //     return $this->nif;
    // }

    // public function setNif($nif)
    // {
    //     $this->nif = $nif;
    // }

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setZipCode($zip_code)
    {
        $this->zip_code = $zip_code;
    }

    public function getSocialSecurity()
    {
        return $this->social_security;
    }

    public function setSocialSecurity($social_security)
    {
        $this->social_security = $social_security;
    }

    public function getTipoEmpleado()
    {
        return $this->tipo_empleado;
    }

    public function setTipoEmpleado($tipo_empleado)
    {
        $this->tipo_empleado = $tipo_empleado;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
    }
}
