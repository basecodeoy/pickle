<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Pickle\Exceptions\NotXmlException;
use BaseCodeOy\Pickle\Values\XML;

it('from string throws exception with invalid xml', function (): void {
    $invalidXmlString = '<root><foo>bar</root>';

    XML::createFromString($invalidXmlString);
})->throws(NotXmlException::class);

it('encoded returns encoded string', function (): void {
    $xmlString = '<root><foo>bar</foo></root>';

    $xml = XML::createFromString($xmlString);

    expect($xml->encoded)->toEqual($xmlString);
});
