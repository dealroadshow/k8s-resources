<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * VolumeMount describes a mounting of a Volume within a container.
 */
class VolumeMount implements JsonSerializable
{
    /**
     * Path within the container at which the volume should be mounted.  Must not
     * contain ':'.
     */
    private string $mountPath;

    /**
     * mountPropagation determines how mounts are propagated from the host to container
     * and the other way around. When not set, MountPropagationNone is used. This field
     * is beta in 1.10.
     */
    private string|null $mountPropagation = null;

    /**
     * This must match the Name of a Volume.
     */
    private string $name;

    /**
     * Mounted read-only if true, read-write otherwise (false or unspecified). Defaults
     * to false.
     */
    private bool|null $readOnly = null;

    /**
     * Path within the volume from which the container's volume should be mounted.
     * Defaults to "" (volume's root).
     */
    private string|null $subPath = null;

    /**
     * Expanded path within the volume from which the container's volume should be
     * mounted. Behaves similarly to SubPath but environment variable references
     * $(VAR_NAME) are expanded using the container's environment. Defaults to ""
     * (volume's root). SubPathExpr and SubPath are mutually exclusive.
     */
    private string|null $subPathExpr = null;

    public function __construct(string $mountPath, string $name)
    {
        $this->mountPath = $mountPath;
        $this->name = $name;
    }

    public function getMountPath(): string
    {
        return $this->mountPath;
    }

    public function getMountPropagation(): string|null
    {
        return $this->mountPropagation;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getSubPath(): string|null
    {
        return $this->subPath;
    }

    public function getSubPathExpr(): string|null
    {
        return $this->subPathExpr;
    }

    public function setMountPath(string $mountPath): self
    {
        $this->mountPath = $mountPath;

        return $this;
    }

    public function setMountPropagation(string $mountPropagation): self
    {
        $this->mountPropagation = $mountPropagation;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setSubPath(string $subPath): self
    {
        $this->subPath = $subPath;

        return $this;
    }

    public function setSubPathExpr(string $subPathExpr): self
    {
        $this->subPathExpr = $subPathExpr;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'mountPath' => $this->mountPath,
            'mountPropagation' => $this->mountPropagation,
            'name' => $this->name,
            'readOnly' => $this->readOnly,
            'subPath' => $this->subPath,
            'subPathExpr' => $this->subPathExpr,
        ];
    }
}
