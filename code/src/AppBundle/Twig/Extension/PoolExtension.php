<?php

/*
 * This file is part of the dokify challenge app package.
 *
 * (c) Rafael Calleja <rafaelcalleja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\Company;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\Pool;

class PoolExtension extends \Twig_Extension implements \Twig_Extension_InitRuntimeInterface
{
    /**
     * @var Pool
     */
    protected $pool;

    /**
     * @param Pool $pool
     */
    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('object_by_admin_and_code', array($this, 'getByCode')),
            new \Twig_SimpleFunction('admin_and_code', array($this, 'getAdminByCode')),
        );
    }

    /**
     * @return Admin
     */
    public function getAdminByCode($code)
    {
        return $this->pool->getAdminByAdminCode($code);
    }

    /**
     * @param string $code
     * @param string $id
     *
     * @return Company
     */
    public function getByCode($code, $id)
    {
        return $this->getAdminByCode($code)->getObject($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sonata_text_formatter';
    }
}
