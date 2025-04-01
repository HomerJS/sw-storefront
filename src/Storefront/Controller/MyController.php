<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Controller;

use Ihor\Storefront\Storefront\Page\Example\ExamplePageLoader;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class MyController extends StorefrontController
{
    public function __construct(
        private readonly ExamplePageLoader $examplePageLoader
    ) {
    }

    #[Route(path: '/test', name: 'frontend.my.test', defaults: ['_httpCache' => true], methods: ['GET'])]
    public function showTest(Request $request, SalesChannelContext $context): Response
    {
        return $this->renderStorefront('@IhorStorefrontPlugin/storefront/page/test.html.twig', [
            'example' => 'Hello world'
        ]);
    }

    #[Route(path: '/ajax', name: 'frontend.my.ajax', defaults: ['XmlHttpRequest' => 'true'], methods: ['GET'])]
    public function showAjax(): JsonResponse
    {
        return new JsonResponse(['timestamp' => (new \DateTime())->format(\DateTimeInterface::W3C)]);
    }

    #[Route(path: '/example', name: 'frontend.my.example', methods: ['GET'])]
    public function showExample(Request $request, SalesChannelContext $context): Response
    {
        $page = $this->examplePageLoader->load($request, $context);

        return $this->renderStorefront('@IhorStorefrontPlugin/storefront/page/example/index.html.twig', [
            'example' => 'Hello world',
            'page' => $page
        ]);
    }
}