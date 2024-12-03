<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Pickle\Exceptions\NotJsonException;

it('value returns exception', function (): void {
    $encoded = '{"foo":"bar"}';

    $notJsonException = NotJsonException::value($encoded);

    $message = \sprintf(
        'Value "%s" is not a valid JSON string.',
        $encoded,
    );

    expect($notJsonException->getMessage())->toBe($message);
});
