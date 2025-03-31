<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Controller;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class MyController extends StorefrontController
{
    #[Route(path: '/test', name: 'frontend.my.test', methods: ['GET'])]
    public function showTest(Request $request, SalesChannelContext $context): Response
    {
        return $this->renderStorefront('@SwagBasicExample/storefront/page/test.html.twig', [
            'example' => 'Hello world'
        ]);
    }
}