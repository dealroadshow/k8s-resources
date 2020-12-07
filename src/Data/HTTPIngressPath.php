<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * HTTPIngressPath associates a path regex with a backend. Incoming urls matching
 * the path are forwarded to the backend.
 */
class HTTPIngressPath implements JsonSerializable
{
    /**
     * Backend defines the referenced service endpoint to which the traffic will be
     * forwarded to.
     */
    private IngressBackend $backend;

    /**
     * Path is an extended POSIX regex as defined by IEEE Std 1003.1, (i.e this follows
     * the egrep/unix syntax, not the perl syntax) matched against the path of an
     * incoming request. Currently it can contain characters disallowed from the
     * conventional "path" part of a URL as defined by RFC 3986. Paths must begin with
     * a '/'. If unspecified, the path defaults to a catch all sending traffic to the
     * backend.
     */
    private string|null $path = null;

    public function __construct(IngressBackend $backend)
    {
        $this->backend = $backend;
    }

    public function getBackend(): IngressBackend
    {
        return $this->backend;
    }

    public function getPath(): string|null
    {
        return $this->path;
    }

    public function setBackend(IngressBackend $backend): self
    {
        $this->backend = $backend;

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
            'backend' => $this->backend,
            'path' => $this->path,
        ];
    }
}
