<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Models;

/**
 * Class MessageOutput
 *
 * @package Kuvardin\Firebase\Models
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageOutput implements ResponseModelInterface
{
    public array $response;

    /**
     * @param array $response
     * @return static
     */
    public static function createFromResponse(array $response): self
    {
        $message_output = new self;
        $message_output->response = $response;
        return $message_output;
    }
}
