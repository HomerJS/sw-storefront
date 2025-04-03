<?php declare(strict_types=1);

namespace Ihor\Storefront\Framework\Cookie;

use Shopware\Storefront\Framework\Cookie\CookieProviderInterface;

class CustomCookieProvider implements CookieProviderInterface
{
    public function __construct(
        private readonly CookieProviderInterface $originalService
    ) {
     }

    private const array singleCookie = [
        'snippet_name' => 'cookie.name',
        'snippet_description' => 'cookie.description ',
        'cookie' => 'cookie-key',
        'value' => 'cookie value',
        'expiration' => '30'
    ];

    // cookies can also be provided as a group
    private const array cookieGroup = [
        'snippet_name' => 'cookie.group_name',
        'snippet_description' => 'cookie.group_description ',
        'entries' => [
            [
                'snippet_name' => 'cookie.first_child_name',
                'cookie' => 'cookie-key-1',
                'value'=> 'cookie value',
                'expiration' => '30'
            ],
            [
                'snippet_name' => 'cookie.second_child_name',
                'cookie' => 'cookie-key-2',
                'value'=> 'cookie value',
                'expiration' => '60'
            ]
        ],
    ];

    public function getCookieGroups(): array
    {
        return array_merge(
            $this->originalService->getCookieGroups(),
            [
                self::cookieGroup,
                self::singleCookie
            ]
        );
    }
}