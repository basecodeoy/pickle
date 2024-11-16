<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Pickle\Exceptions;

final class NotXmlException extends \InvalidArgumentException
{
    public static function value(string $value): self
    {
        return new self(\sprintf(
            'Value "%s" is not a valid XML string.',
            $value,
        ));
    }
}
