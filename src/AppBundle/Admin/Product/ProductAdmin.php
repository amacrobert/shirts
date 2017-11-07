<?php

namespace AppBundle\Admin\Product;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends AbstractAdmin {

    protected $datagridValues = [
        '_sort_by' => 'ordinal',
        '_sort_order' => 'ASC',
    ];

    protected function configureFormFields(FormMapper $formMapper) {

        $sexes = [
            'Men' => 'men',
            'Women' => 'women',
        ];

        $formMapper
            ->with('General', ['class' => 'col-md-6'])
                ->add('id', null, ['disabled' => true])
                ->add('name')
                ->add('link', 'url', ['required' => false])
                ->add('price')
                ->add('sex', 'choice', ['choices' => $sexes, 'required' => false])
                ->add('description')
            ->end()
            ->with('Images', ['class' => 'col-md-6'])
                ->add('featured_image')
                ->add('product_images')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('name')
            ->add('sex')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('ordinal', 'integer', ['editable' => true])
            ->addIdentifier('name')
            ->add('sex')
            ->add('price')
            ->add('_action', null, [
                    'actions' => [
                        'show' => [],
                        'edit' => [],
                        'delete' => [],
                ]
            ])
        ;
    }

}
