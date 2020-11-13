<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Models;

use Error;

/**
 * Class Target
 *
 * @package Kuvardin\Firebase\Models
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Target implements RequestModelInterface
{
    /**
     * @var string|null Registration token to send a message to.
     */
    protected ?string $token = null;

    /**
     * @var string|null Topic name to send a message to, e.g. "weather". Note: "/topics/" prefix should not be provided.
     */
    protected ?string $topic = null;

    /**
     * @var string|null Condition to send a message to, e.g. "'foo' in topics && 'bar' in topics".
     */
    protected ?string $condition = null;

    /**
     * Target constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $token Registration token to send a message to.
     * @return static
     */
    public static function createWithToken(string $token): self
    {
        $target = new self;
        $target->token = $token;
        return $target;
    }

    /**
     * @param string $topic Topic name to send a message to, e.g. "weather".
     * Note: "/topics/" prefix should not be provided.
     * @return static
     */
    public static function createWithTopic(string $topic): self
    {
        $target = new self;
        $target->topic = $topic;
        return $target;
    }

    /**
     * @param string $condition Condition to send a message to, e.g. "'foo' in topics && 'bar' in topics".
     * @return static
     */
    public static function createWithCondition(string $condition): self
    {
        $target = new self;
        $target->condition = $condition;
        return $target;
    }

    /**
     * @return null[]|string[]
     */
    public function getRequestData(): array
    {
        if ($this->token !== null) {
            return [
                'token' => $this->token,
            ];
        }

        if ($this->topic !== null) {
            return [
                'topic' => $this->topic,
            ];
        }

        if ($this->condition !== null) {
            return [
                'condition' => $this->condition,
            ];
        }

        throw new Error('Empty target');
    }
}
