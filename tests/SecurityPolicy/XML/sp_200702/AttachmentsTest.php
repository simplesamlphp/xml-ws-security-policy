<?php

declare(strict_types=1);

namespace SimpleSAML\Test\WebServices\SecurityPolicy\XML\sp_200702;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractEmptyType;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AbstractSpElement;
use SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\Attachments;
use SimpleSAML\XML\DOMDocumentFactory;
use SimpleSAML\XML\TestUtils\SerializableElementTestTrait;

use function dirname;

/**
 * Class \SimpleSAML\WebServices\SecurityPolicy\XML\sp_200702\AttachmentsTest
 *
 * @package simplesamlphp/xml-ws-security-policy
 */
#[Group('sp')]
#[CoversClass(Attachments::class)]
#[CoversClass(AbstractEmptyType::class)]
#[CoversClass(AbstractSpElement::class)]
final class AttachmentsTest extends TestCase
{
    use SerializableElementTestTrait;


    /**
     */
    public static function setUpBeforeClass(): void
    {
        self::$testedClass = Attachments::class;

        self::$xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 4) . '/resources/xml/sp/200702/Attachments.xml',
        );
    }


    // test marshalling


    /**
     * Test that creating an Attachments from scratch works.
     */
    public function testMarshalling(): void
    {
        $attachments = new Attachments();

        $this->assertEquals(
            self::$xmlRepresentation->saveXML(self::$xmlRepresentation->documentElement),
            strval($attachments),
        );
    }
}
