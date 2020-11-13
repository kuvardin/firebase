<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Models;

/**
 * Interface RequestModelInterface
 *
 * @package Kuvardin\Firebase\Models
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
interface RequestModelInterface
{
    /**
     * @return array
     */
    public function getRequestData(): array;
}
