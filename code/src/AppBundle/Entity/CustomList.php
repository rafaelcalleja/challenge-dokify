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
 */
class CustomList
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $empresa;

    /**
     * @var string
     */
    protected $relacion;

    /**
     * @var string
     */
    protected $vinculo;

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function empresa()
    {
        return $this->empresa;
    }

    /**
     * @param string $empresa
     */
    private function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * @return string
     */
    public function relacion()
    {
        return $this->relacion;
    }

    /**
     * @param string $relacion
     */
    private function setRelacion($relacion)
    {
        $this->relacion = $relacion;
    }

    /**
     * @return string
     */
    public function vinculo()
    {
        return $this->vinculo;
    }

    /**
     * @param string $vinculo
     */
    private function setVinculo($vinculo)
    {
        $this->vinculo = $vinculo;
    }

    public function __toString()
    {
        return sprintf('[%s (%s <> %s )]', $this->vinculo(), $this->empresa(), $this->relacion());
    }
}
