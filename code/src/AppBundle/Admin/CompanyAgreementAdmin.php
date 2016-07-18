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

class CompanyAgreementAdmin extends Admin
{
    /**
     * Default Datagrid values.
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page'       => 1,            // display the first page (default = 1)
        '_sort_order' => 'ASC', // reverse order (default = 'ASC')
        '_sort_by'    => 'agreement.name',  // name of the ordered field
    );

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('agreement')
            ->add('companyId')
            ->add('buyer')
            ->add('payer')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('agreement.name')
            ->addIdentifier('companyId.name', null, array('label' => 'Company'))
            ->add('buyer.name')
            ->add('payer.name')
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('agreement')
            ->add('companyId')
            ->add('buyer')
            ->add('payer')
        ;
    }

    public function getExportFields()
    {
        return array(
            'agreement.name',
            'companyId.name',
            'buyer.name',
            'payer.name'
        );
    }
}
