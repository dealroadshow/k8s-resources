<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents an NFS mount that lasts the lifetime of a pod. NFS volumes do not
 * support ownership management or SELinux relabeling.
 */
class NFSVolumeSource implements JsonSerializable
{
    /**
     * Path that is exported by the NFS server. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     */
    private string $path;

    /**
     * ReadOnly here will force the NFS export to be mounted with read-only
     * permissions. Defaults to false. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     */
    private bool|null $readOnly = null;

    /**
     * Server is the hostname or IP address of the NFS server. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     */
    private string $server;

    public function __construct(string $path, string $server)
    {
        $this->path = $path;
        $this->server = $server;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getServer(): string
    {
        return $this->server;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setServer(string $server): self
    {
        $this->server = $server;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'path' => $this->path,
            'readOnly' => $this->readOnly,
            'server' => $this->server,
        ];
    }
}
