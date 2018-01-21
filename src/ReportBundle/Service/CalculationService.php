<?php

namespace ReportBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class CalculationService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function calculate()
    {

    }

}