<?php

/*
 * This file is part of the ccip package.
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


class CompanyAgreementAdmin extends Admin
{

    /**
     * Default Datagrid values.
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page'       => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by'    => 'id',  // name of the ordered field
    );

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('agreement')
            ->add('companyId', 'doctrine_orm_choice', array(
                'label' => 'Company',
                'field_options' => array(
                    'choices' => $this->getCompanies(),
                    'required' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'attr'=> ['data-sonata-select2-minimun-input'=> 2 ]
                ),
                'field_type' => 'choice'))
            ->add('buyer', 'doctrine_orm_choice', array(
                'field_options' => array(
                    'choices' => $this->getCompanies(),
                    'required' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'attr'=> ['data-sonata-select2-minimun-input'=> 2 ]
                ),
                'field_type' => 'choice'))
            ->add('payer', 'doctrine_orm_choice', array(
                'field_options' => array(
                    'choices' => $this->getCompanies(),
                    'required' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'attr'=> ['data-sonata-select2-minimun-input'=> 2 ]
                ),
                'field_type' => 'choice'))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        //$collection->clearExcept(array('list', 'export'));
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('agreement')
            ->addIdentifier('companyId', 'string', array('label' => 'Company', 'template' => 'AppBundle::list_custom.html.twig'))
            ->add('buyer', 'string', array('template' => 'AppBundle::list_custom.html.twig'))
            ->add('payer', 'string', array('template' => 'AppBundle::list_custom.html.twig'))
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('agreement')
            ->add('companyId', 'choice', [
                'multiple' => false,
                'choices' => $this->getCompanies()
            ])
            ->add('buyer', 'choice', [
                'multiple' => false,
                'choices' => $this->getCompanies()
            ])
            ->add('payer', 'choice', [
                'multiple' => false,
                'choices' => $this->getCompanies()
            ])
        ;
    }

    protected function getCompanies()
    {
        $em = $this->modelManager->getEntityManager('AppBundle\Entity\Company');

        $qb = $em->createQueryBuilder();

        $qb = $qb->select('PARTIAL u.{id, name}')
            ->add('from', 'AppBundle\Entity\Company u');

        $query = $qb->getQuery();
        $arrayType = $query->getArrayResult();

        $data  = array();
        foreach ($arrayType as $dataRow) {
            $data [$dataRow['id']] = $dataRow['name'];
        }
        return $data;

    }

}