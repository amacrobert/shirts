<?php

namespace AppBundle\Admin\Product;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

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

        $types = [
            'Short Sleeve T' => 'short-sleeve-t',
            'Long Sleeve T' => 'long-sleeve-t'
        ];

        $formMapper
            ->with('General', ['class' => 'col-md-4'])
                ->add('active')
                ->add('name')
                ->add('link', 'url', ['required' => false])
                ->add('price')
                ->add('sex', 'choice', ['choices' => $sexes, 'required' => false])
                ->add('type', 'choice', ['choices' => $types, 'required' => true])
                ->add('description')
            ->end()
            ->with('Images', ['class' => 'col-md-8', 'description' => 'The first product image will be featured on the main page'])
                ->add('product_images', 'sonata_type_collection', ['by_reference' => false], ['edit' => 'inline', 'inline' => 'table', 'sortable' => 'ordinal'])
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
            ->add('active', null, ['editable' => true])
            ->add('ordinal', 'integer', ['editable' => true])
            ->addIdentifier('name')
            ->add('link', 'url', ['attributes' => ['target' => '_blank']])
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

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('name')
            ->add('link', 'url')
        ;
    }

}
