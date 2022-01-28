<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StatusCauseList;
use JsonSerializable;

/**
 * StatusDetails is a set of additional properties that MAY be set by the server to
 * provide additional information about a response. The Reason field of a Status
 * object defines what attributes will be set. Clients must ignore fields that do
 * not match the defined type of each attribute, and should assume that any
 * attribute may be empty, invalid, or under defined.
 */
class StatusDetails implements JsonSerializable
{
    /**
     * The Causes array includes more details associated with the StatusReason failure.
     * Not all StatusReasons may provide detailed causes.
     */
    private StatusCauseList $causes;

    /**
     * The group attribute of the resource associated with the status StatusReason.
     */
    private string|null $group = null;

    /**
     * The kind attribute of the resource associated with the status StatusReason. On
     * some operations may differ from the requested resource Kind. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private string|null $kind = null;

    /**
     * The name attribute of the resource associated with the status StatusReason (when
     * there is a single name which can be described).
     */
    private string|null $name = null;

    /**
     * If specified, the time in seconds before the operation should be retried. Some
     * errors may indicate the client must take an alternate action - for those errors
     * this field may indicate how long to wait before taking the alternate action.
     */
    private int|null $retryAfterSeconds = null;

    /**
     * UID of the resource. (when there is a single resource which can be described).
     * More info: http://kubernetes.io/docs/user-guide/identifiers#uids
     */
    private string|null $uid = null;

    public function __construct()
    {
        $this->causes = new StatusCauseList();
    }

    public function causes(): StatusCauseList
    {
        return $this->causes;
    }

    public function getGroup(): string|null
    {
        return $this->group;
    }

    public function getKind(): string|null
    {
        return $this->kind;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getRetryAfterSeconds(): int|null
    {
        return $this->retryAfterSeconds;
    }

    public function getUid(): string|null
    {
        return $this->uid;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

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

    public function setRetryAfterSeconds(int $retryAfterSeconds): self
    {
        $this->retryAfterSeconds = $retryAfterSeconds;

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
            'causes' => $this->causes,
            'group' => $this->group,
            'kind' => $this->kind,
            'name' => $this->name,
            'retryAfterSeconds' => $this->retryAfterSeconds,
            'uid' => $this->uid,
        ];
    }
}
