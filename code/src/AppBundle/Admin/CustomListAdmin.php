<?php

/*
 * This file is part of the dokify challenge app package.
 *
 * (c) Rafael Calleja <rafaelcalleja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CustomListAdmin extends Admin
{
    /**
     * Default Datagrid values.
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page'       => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by'    => 'empresa',  // name of the ordered field
    );

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $fields = array(
            'empresa',
            'relacion',
            'vinculo',
        );

        array_map(function ($field) use ($filterMapper) {
            $filterMapper->add($field);
        }, $fields);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        $collection->clearExcept(array('list', 'export'));
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('empresa')
            ->add('relacion')
            ->add('vinculo')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
    }
}
