<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Pickle\Values;

use BaseCodeOy\Pickle\Exceptions\NotXmlException;
use Saloon\XmlWrangler\XmlReader;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class XML extends Data implements \Stringable, Castable
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
     * @throws NotXmlException
     */
    public static function createFromString(string $encoded): self
    {
        try {
            $decoded = XmlReader::fromString($encoded)->elements();
        } catch (\Throwable) {
            throw NotXmlException::value($encoded);
        }

        return new self($encoded, $decoded);
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
            {
                return XmlReader::fromString((string) $value);
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
