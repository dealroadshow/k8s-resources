<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * TokenRequest contains parameters of a service account token.
 */
class TokenRequest implements JsonSerializable
{
    /**
     * Audience is the intended audience of the token in "TokenRequestSpec". It will
     * default to the audiences of kube apiserver.
     */
    private string $audience;

    /**
     * ExpirationSeconds is the duration of validity of the token in
     * "TokenRequestSpec". It has the same default value of "ExpirationSeconds" in
     * "TokenRequestSpec".
     */
    private int|null $expirationSeconds = null;

    public function __construct(string $audience)
    {
        $this->audience = $audience;
    }

    public function getAudience(): string
    {
        return $this->audience;
    }

    public function getExpirationSeconds(): int|null
    {
        return $this->expirationSeconds;
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

    public function jsonSerialize(): array
    {
        return [
            'audience' => $this->audience,
            'expirationSeconds' => $this->expirationSeconds,
        ];
    }
}
