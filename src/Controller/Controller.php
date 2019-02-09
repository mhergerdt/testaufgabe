<?php

namespace App\Controller;

use App\Component\Checkout\CashRegisterFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Controller extends AbstractController
{
    public function index(CashRegisterFactory $cashRegisterFactory)
    {
        /**
         * If you dont't type hint the class in a controller it won't get loaded in the service container when using
         * KernelTestCase.
         */
    }
}
