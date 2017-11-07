<?php

namespace AppBundle\Admin\Product;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ImageAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
            ->add('id', null, ['disabled' => true])
            ->add('image')
            ->add('ordinal')
        ;
    }
}
