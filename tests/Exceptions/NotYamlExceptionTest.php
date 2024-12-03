<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Pickle\Exceptions\NotYamlException;

it('value returns exception', function (): void {
    $encoded = '{"foo":"bar"}';

    $notYamlException = NotYamlException::value($encoded);

    $message = \sprintf(
        'Value "%s" is not a valid YAML string.',
        $encoded,
    );

    expect($notYamlException->getMessage())->toBe($message);
});
