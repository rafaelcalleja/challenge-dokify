<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyHasAgreement
 */
class CompanyHasAgreement
{
    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var integer
     */
    private $buyer;

    /**
     * @var integer
     */
    private $payer;

    /**
     * @var \AppBundle\Entity\Agreement
     */
    private $agreement;


    /**
     * Set companyId
     *
     * @param integer $companyId
     * @return CompanyHasAgreement
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set buyer
     *
     * @param integer $buyer
     * @return CompanyHasAgreement
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer
     *
     * @return integer 
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set payer
     *
     * @param integer $payer
     * @return CompanyHasAgreement
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer
     *
     * @return integer 
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set agreement
     *
     * @param \AppBundle\Entity\Agreement $agreement
     * @return CompanyHasAgreement
     */
    public function setAgreement(\AppBundle\Entity\Agreement $agreement = null)
    {
        $this->agreement = $agreement;

        return $this;
    }

    /**
     * Get agreement
     *
     * @return \AppBundle\Entity\Agreement 
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    public function __toString()
    {
        return sprintf("[%s (%s <> %s ) %s]", $this->getCompanyId(), $this->getBuyer(), $this->getPayer(), $this->getAgreement());
    }
}
