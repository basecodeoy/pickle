<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Pickle\Values;

use BaseCodeOy\Pickle\Exceptions\NotYamlException;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as Symfony;

final class YAML extends Data implements \Stringable, Castable
{
    public function __construct(
        public readonly string $encoded,
        public readonly array $decoded,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->encoded;
    }

    /**
     * @throws NotYamlException
     */
    public static function createFromString(string $encoded): self
    {
        try {
            $decoded = (array) Symfony::parse($encoded);
        } catch (ParseException) {
            throw NotYamlException::value($encoded);
        }

        return new self($encoded, $decoded);
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $dataProperty, mixed $value, array $properties, CreationContext $creationContext): mixed
            {
                return YAML::createFromString((string) $value);
            }
        };
    }

    public function isEqualTo(self $other): bool
    {
        return $this->encoded === $other->toString();
    }

    public function toString(): string
    {
        return $this->encoded;
    }
}
