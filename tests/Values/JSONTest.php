<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Pickle\Exceptions\NotJsonException;
use BaseCodeOy\Pickle\Values\JSON;

it('from string throws exception with invalid json', function (): void {
    $invalidJsonString = '{"foo":bar}';

    JSON::createFromString($invalidJsonString);
})->throws(NotJsonException::class);

it('encoded returns encoded string', function (): void {
    $jsonString = '{"foo":"bar"}';

    $json = JSON::createFromString($jsonString);

    expect($json->encoded)->toEqual($jsonString);
});
