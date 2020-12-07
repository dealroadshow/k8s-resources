<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * NonResourceAttributes includes the authorization attributes available for
 * non-resource requests to the Authorizer interface
 */
class NonResourceAttributes implements JsonSerializable
{
    /**
     * Path is the URL path of the request
     */
    private string|null $path = null;

    /**
     * Verb is the standard HTTP verb
     */
    private string|null $verb = null;

    public function __construct()
    {
    }

    public function getPath(): string|null
    {
        return $this->path;
    }

    public function getVerb(): string|null
    {
        return $this->verb;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setVerb(string $verb): self
    {
        $this->verb = $verb;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'path' => $this->path,
            'verb' => $this->verb,
        ];
    }
}
