<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ServiceAccountTokenProjection represents a projected service account token
 * volume. This projection can be used to insert a service account token into the
 * pods runtime filesystem for use against APIs (Kubernetes API Server or
 * otherwise).
 */
class ServiceAccountTokenProjection implements JsonSerializable
{
    /**
     * audience is the intended audience of the token. A recipient of a token must
     * identify itself with an identifier specified in the audience of the token, and
     * otherwise should reject the token. The audience defaults to the identifier of
     * the apiserver.
     */
    private string|null $audience = null;

    /**
     * expirationSeconds is the requested duration of validity of the service account
     * token. As the token approaches expiration, the kubelet volume plugin will
     * proactively rotate the service account token. The kubelet will start trying to
     * rotate the token if the token is older than 80 percent of its time to live or if
     * the token is older than 24 hours.Defaults to 1 hour and must be at least 10
     * minutes.
     */
    private int|null $expirationSeconds = null;

    /**
     * path is the path relative to the mount point of the file to project the token
     * into.
     */
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getAudience(): string|null
    {
        return $this->audience;
    }

    public function getExpirationSeconds(): int|null
    {
        return $this->expirationSeconds;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setAudience(string $audience): self
    {
        $this->audience = $audience;

        return $this;
    }

    public function setExpirationSeconds(int $expirationSeconds): self
    {
        $this->expirationSeconds = $expirationSeconds;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'audience' => $this->audience,
            'expirationSeconds' => $this->expirationSeconds,
            'path' => $this->path,
        ];
    }
}
