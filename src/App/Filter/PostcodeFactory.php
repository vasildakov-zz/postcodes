<?php

namespace App\Filter;

use Zend\Filter;
use Zend\InputFilter;
use Zend\Validator;
use Interop\Container\ContainerInterface;

class PostcodeFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $postcode = new InputFilter\Input('postcode');

        $postcode->getFilterChain()->attach(new Filter\StringTrim());
        $postcode->getValidatorChain()->attach(new \App\Validator\PostCode());

        $filter = new InputFilter\InputFilter();
        $filter->add($postcode);

        return $filter;
    }
}
