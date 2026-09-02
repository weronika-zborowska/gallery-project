<?php

/**
 * Application kernel.
 */

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Main application kernel.
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
