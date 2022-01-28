<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * OwnerReference contains enough information to let you identify an owning object.
 * An owning object must be in the same namespace as the dependent, or be
 * cluster-scoped, so there is no namespace field.
 */
class OwnerReference implements JsonSerializable
{
    /**
     * API version of the referent.
     */
    private string $apiVersion;

    /**
     * If true, AND if the owner has the "foregroundDeletion" finalizer, then the owner
     * cannot be deleted from the key-value store until this reference is removed.
     * Defaults to false. To set this field, a user needs "delete" permission of the
     * owner, otherwise 422 (Unprocessable Entity) will be returned.
     */
    private bool|null $blockOwnerDeletion = null;

    /**
     * If true, this reference points to the managing controller.
     */
    private bool|null $controller = null;

    /**
     * Kind of the referent. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private string $kind;

    /**
     * Name of the referent. More info:
     * http://kubernetes.io/docs/user-guide/identifiers#names
     */
    private string $name;

    /**
     * UID of the referent. More info:
     * http://kubernetes.io/docs/user-guide/identifiers#uids
     */
    private string $uid;

    public function __construct(string $apiVersion, string $kind, string $name, string $uid)
    {
        $this->apiVersion = $apiVersion;
        $this->kind = $kind;
        $this->name = $name;
        $this->uid = $uid;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getBlockOwnerDeletion(): bool|null
    {
        return $this->blockOwnerDeletion;
    }

    public function getController(): bool|null
    {
        return $this->controller;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setBlockOwnerDeletion(bool $blockOwnerDeletion): self
    {
        $this->blockOwnerDeletion = $blockOwnerDeletion;

        return $this;
    }

    public function setController(bool $controller): self
    {
        $this->controller = $controller;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => $this->apiVersion,
            'blockOwnerDeletion' => $this->blockOwnerDeletion,
            'controller' => $this->controller,
            'kind' => $this->kind,
            'name' => $this->name,
            'uid' => $this->uid,
        ];
    }
}
