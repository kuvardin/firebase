<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Models;

/**
 * Interface ResponseModelInterface
 *
 * @package Kuvardin\Firebase\Models
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
interface ResponseModelInterface
{
    /**
     * @param array $response
     * @return $this
     */
    public static function createFromResponse(array $response): self;
}
