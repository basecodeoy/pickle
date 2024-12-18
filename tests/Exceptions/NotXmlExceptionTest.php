<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Pickle\Exceptions\NotXmlException;

it('value returns exception', function (): void {
    $encoded = '{"foo":"bar"}';

    $notXmlException = NotXmlException::value($encoded);

    $message = \sprintf(
        'Value "%s" is not a valid XML string.',
        $encoded,
    );

    expect($notXmlException->getMessage())->toBe($message);
});
