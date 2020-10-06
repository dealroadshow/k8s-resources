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
     *
     * @var string|null
     */
    private ?string $path = null;

    /**
     * Verb is the standard HTTP verb
     *
     * @var string|null
     */
    private ?string $verb = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getVerb(): ?string
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

    public function jsonSerialize()
    {
        return [
            'path' => $this->path,
            'verb' => $this->verb,
        ];
    }
}
