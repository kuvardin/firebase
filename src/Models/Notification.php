<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Models;

/**
 * Basic notification template to use across all platforms.
 *
 * @package Kuvardin\Firebase\Models
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Notification implements RequestModelInterface
{
    /**
     * @var string|null The notification's title.
     */
    public ?string $title = null;

    /**
     * @var string|null The notification's body text.
     */
    public ?string $body = null;

    /**
     * @var string|null Contains the URL of an image that is going to be downloaded on the device and displayed
     * in a notification. JPEG, PNG, BMP have full support across platforms. Animated GIF and video only work on iOS.
     * WebP and HEIF have varying levels of support across platforms and platform versions. Android has 1MB image
     * size limit. Quota usage and implications/costs for hosting image
     * on Firebase Storage: https://firebase.google.com/pricing
     */
    public ?string $image = null;

    /**
     * Notification constructor.
     *
     * @param string|null $title The notification's title.
     * @param string|null $body The notification's body text.
     * @param string|null $image Contains the URL of an image that is going to be downloaded on the device and displayed
     * in a notification. JPEG, PNG, BMP have full support across platforms. Animated GIF and video only work on iOS.
     * WebP and HEIF have varying levels of support across platforms and platform versions. Android has 1MB image
     * size limit. Quota usage and implications/costs for hosting image
     * on Firebase Storage: https://firebase.google.com/pricing
     */
    public function __construct(string $title = null, string $body = null, string $image = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function getRequestData(): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $this->image,
        ];
    }
}
