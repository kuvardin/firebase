<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Exceptions;

use Exception;
use Throwable;

/**
 * Class ApiError
 *
 * @package Kuvardin\Firebase\Exceptions
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ApiError extends Exception
{
    /**
     * @var string
     */
    protected string $status;

    /**
     * ApiError constructor.
     *
     * @param int $code
     * @param string $status
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(int $code, string $status, string $message, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->status = $status;
    }
}
