<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Subject matches the originator of a request, as identified by the request
 * authentication system. There are three ways of matching an originator; by user,
 * group, or service account.
 */
class Subject implements JsonSerializable
{
    private GroupSubject|null $group = null;

    /**
     * Required
     */
    private string $kind;
    private ServiceAccountSubject|null $serviceAccount = null;
    private UserSubject|null $user = null;

    public function __construct(string $kind)
    {
        $this->kind = $kind;
    }

    public function getGroup(): GroupSubject|null
    {
        return $this->group;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getServiceAccount(): ServiceAccountSubject|null
    {
        return $this->serviceAccount;
    }

    public function getUser(): UserSubject|null
    {
        return $this->user;
    }

    public function setGroup(GroupSubject $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setServiceAccount(ServiceAccountSubject $serviceAccount): self
    {
        $this->serviceAccount = $serviceAccount;

        return $this;
    }

    public function setUser(UserSubject $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'group' => $this->group,
            'kind' => $this->kind,
            'serviceAccount' => $this->serviceAccount,
            'user' => $this->user,
        ];
    }
}
