<?php

/*
 * This file is part of the dokify challenge app package.
 *
 * (c) Rafael Calleja <rafaelcalleja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

/**
 * CompanyHasAgreement.
 */
class CompanyHasAgreement
{
    /**
     * @var int
     */
    private $companyId;

    /**
     * @var int
     */
    private $buyer;

    /**
     * @var int
     */
    private $payer;

    /**
     * @var \AppBundle\Entity\Agreement
     */
    private $agreement;

    /**
     * Set companyId.
     *
     * @param int $companyId
     *
     * @return CompanyHasAgreement
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set buyer.
     *
     * @param int $buyer
     *
     * @return CompanyHasAgreement
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer.
     *
     * @return int
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set payer.
     *
     * @param int $payer
     *
     * @return CompanyHasAgreement
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer.
     *
     * @return int
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set agreement.
     *
     * @param \AppBundle\Entity\Agreement $agreement
     *
     * @return CompanyHasAgreement
     */
    public function setAgreement(\AppBundle\Entity\Agreement $agreement = null)
    {
        $this->agreement = $agreement;

        return $this;
    }

    /**
     * Get agreement.
     *
     * @return \AppBundle\Entity\Agreement
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    public function __toString()
    {
        return sprintf('[%s (%s <> %s ) %s]', $this->getCompanyId(), $this->getBuyer(), $this->getPayer(), $this->getAgreement());
    }
}
