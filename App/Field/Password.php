<?php

namespace App\Field;

use App\Field;

/**
 * Class Password
 *
 * @package App\Field
 */
class Password extends Text
{

    /**
     * @var string
     */
    protected string $type = 'password';

    /**
     * @var array|string[]
     */
    protected array $attributes = [
        'autocomplete' => 'off',
    ];

    /**
     * @var bool
     */
    protected bool $sensitiveContents = true;
}
