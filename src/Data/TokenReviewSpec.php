<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * TokenReviewSpec is a description of the token authentication request.
 */
class TokenReviewSpec implements JsonSerializable
{
    /**
     * Audiences is a list of the identifiers that the resource server presented with
     * the token identifies as. Audience-aware token authenticators will verify that
     * the token was intended for at least one of the audiences in this list. If no
     * audiences are provided, the audience will default to the audience of the
     * Kubernetes apiserver.
     */
    private StringList $audiences;

    /**
     * Token is the opaque bearer token.
     */
    private string|null $token = null;

    public function __construct()
    {
        $this->audiences = new StringList();
    }

    public function audiences(): StringList
    {
        return $this->audiences;
    }

    public function getToken(): string|null
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'audiences' => $this->audiences,
            'token' => $this->token,
        ];
    }
}
