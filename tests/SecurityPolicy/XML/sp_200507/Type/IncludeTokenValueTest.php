<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200507\Type;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\IncludeToken;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValue;
use SimpleSAML\XMLSchema\Exception\SchemaViolationException;

/**
 * Class \SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200507\Type\IncludeTokenValueTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('type')]
#[CoversClass(IncludeTokenValue::class)]
final class IncludeTokenValueTest extends TestCase
{
    /**
     * @param boolean $shouldPass
     * @param string $uri
     */
    #[DataProvider('provideURI')]
    public function testIncludeToken(bool $shouldPass, string $uri): void
    {
        try {
            IncludeTokenValue::fromString($uri);
            $this->assertTrue($shouldPass);
        } catch (SchemaViolationException $e) {
            $this->assertFalse($shouldPass);
        }
    }


    /**
     * @return array<string, array{0: bool, 1: string}>
     */
    public static function provideURI(): array
    {
        return [
            'Always' => [true, IncludeToken::Always->value],
            'AlwaysToRecipient' => [true, IncludeToken::AlwaysToRecipient->value],
            'Once' => [true, IncludeToken::Once->value],
            'Never' => [true, IncludeToken::Never->value],
            'urn' => [false, 'urn:x-simplesamlphp:phpunit'],
            'same-doc' => [false, '#_53d830ab1be17291a546c95c7f1cdf8d3d23c959e6'],
            'url' => [false, 'https://www.simplesamlphp.org'],
            'diacritical' => [false, 'https://aä.com'],
            'spn' => [false, 'spn:a4cf592f-a64c-46ff-a788-b260f474525b'],
            'typos' => [false, 'https//www.uni.l/en/'],
            'spaces' => [false, 'this is silly'],
            'empty' => [false, ''],
            'azure-common' => [false, 'https://sts.windows.net/{tenantid}/'],
        ];
    }
}
