<?php declare(strict_types=1);

namespace Ihor\Storefront\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class newFunctions  extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('createMd5Hash', [$this, 'createMd5Hash']),
        ];
    }

    public function createMd5Hash(string $str)
    {
        return md5($str);
    }
}