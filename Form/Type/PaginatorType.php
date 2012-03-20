<?php
namespace SoftCode\GridBundle\Form\Type;
use Symfony\Component\Form\FormBuilder;

use Symfony\Component\Form\AbstractType;

/**
 * @author Baldur
 *
 */
class PaginatorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('page', 'integer');
        $builder->add('resultsPerPage', 'integer');
    }

    public function getName()
    {
        return 'grid_paginator';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'SoftCOde/GridBundle/Paginator/PagePaginator'
        );
    }
}
