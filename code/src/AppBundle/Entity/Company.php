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
 * Company.
 */
class Company
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $clients;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $providers;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->providers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add clients.
     *
     * @param \AppBundle\Entity\Company $clients
     *
     * @return Company
     */
    public function addClient(\AppBundle\Entity\Company $clients)
    {
        $this->clients[] = $clients;

        return $this;
    }

    /**
     * Remove clients.
     *
     * @param \AppBundle\Entity\Company $clients
     */
    public function removeClient(\AppBundle\Entity\Company $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add providers.
     *
     * @param \AppBundle\Entity\Company $providers
     *
     * @return Company
     */
    public function addProvider(\AppBundle\Entity\Company $providers)
    {
        $this->providers[] = $providers;

        return $this;
    }

    /**
     * Remove providers.
     *
     * @param \AppBundle\Entity\Company $providers
     */
    public function removeProvider(\AppBundle\Entity\Company $providers)
    {
        $this->providers->removeElement($providers);
    }

    /**
     * Get providers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProviders()
    {
        return $this->providers;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
