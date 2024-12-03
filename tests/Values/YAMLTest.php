<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Pickle\Exceptions\NotYamlException;
use BaseCodeOy\Pickle\Values\YAML;

it('can be created from string', function (): void {
    $yamlString = 'foo: bar';

    $yaml = YAML::createFromString($yamlString);

    expect($yaml->decoded)->toEqual(['foo' => 'bar']);
});

it('to string returns encoded string', function (): void {
    $yamlString = 'foo: bar';

    $yaml = YAML::createFromString($yamlString);

    expect((string) $yaml)->toEqual($yamlString);
});

it('from string throws exception with invalid yaml', function (): void {
    $invalidYamlString = '{this is not valid yaml}';

    YAML::createFromString($invalidYamlString);
})->throws(NotYamlException::class);

it('decoded returns decoded array', function (): void {
    $yamlString = 'foo: bar';

    $yaml = YAML::createFromString($yamlString);

    expect($yaml->decoded)->toEqual(['foo' => 'bar']);
});

it('encoded returns encoded string', function (): void {
    $yamlString = 'foo: bar';

    $yaml = YAML::createFromString($yamlString);

    expect($yaml->encoded)->toEqual($yamlString);
});
