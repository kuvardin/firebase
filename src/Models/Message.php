<?php

declare(strict_types=1);

namespace Kuvardin\Firebase\Models;

/**
 * Message to send by Firebase Cloud Messaging Service.
 *
 * @package Kuvardin\Firebase\Models
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Message implements RequestModelInterface
{
    /**
     * @var Target
     */
    protected Target $target;

    /**
     * @var string[] Arbitrary key/value payload.
     * The key should not be a reserved word ("from", "message_type", or any word starting with "google" or "gcm").
     * An object containing a list of "key": value pairs. Example: { "name": "wrench", "mass": "1.3kg", "count": "3" }.
     */
    public array $data = [];

    /**
     * @var Notification|null Basic notification template to use across all platforms.
     */
    public ?Notification $notification = null;

    /**
     * @var AndroidConfig|null Android specific options for messages sent through FCM connection server.
     */
    public ?AndroidConfig $android = null;

    /**
     * @var WebpushConfig|null Webpush protocol options.
     */
    public ?WebpushConfig $webpush = null;

    /**
     * @var ApnsConfig|null Apple Push Notification Service specific options.
     */
    public ?ApnsConfig $apns = null;

    /**
     * @var FmcOptions|null Template for FCM SDK feature options to use across all platforms.
     */
    public ?FmcOptions $fcm_options = null;

    /**
     * Message constructor.
     *
     * @param Target $target
     * @param Notification|null $notification
     * @param string[] $data
     * @param AndroidConfig|null $android
     * @param WebpushConfig|null $webpush
     * @param ApnsConfig|null $apns
     * @param FmcOptions|null $fcm_options
     */
    public function __construct(
        Target $target,
        Notification $notification = null,
        array $data = [],
        AndroidConfig $android = null,
        WebpushConfig $webpush = null,
        ApnsConfig $apns = null,
        FmcOptions $fcm_options = null
    ) {
        $this->target = $target;
        $this->data = $data;
        $this->notification = $notification;
        $this->android = $android;
        $this->webpush = $webpush;
        $this->apns = $apns;
        $this->fcm_options = $fcm_options;
    }

    /**
     * @return array
     */
    public function getRequestData(): array
    {
        return array_merge([
            'data' => $this->data,
            'notification' => $this->notification === null ? null : $this->notification->getRequestData(),
            'android' => $this->android === null ? null : $this->android->getRequestData(),
            'webpush' => $this->webpush === null ? null : $this->webpush->getRequestData(),
            'apns' => $this->apns === null ? null : $this->apns->getRequestData(),
            'fcm_options' => $this->fcm_options === null ? null : $this->fcm_options->getRequestData(),
        ], $this->target->getRequestData());
    }

}
