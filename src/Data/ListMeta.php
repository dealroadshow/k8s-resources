<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ListMeta describes metadata that synthetic resources must have, including lists
 * and various status objects. A resource may have only one of {ObjectMeta,
 * ListMeta}.
 */
class ListMeta implements JsonSerializable
{
    /**
     * continue may be set if the user set a limit on the number of items returned, and
     * indicates that the server has more data available. The value is opaque and may
     * be used to issue another request to the endpoint that served this list to
     * retrieve the next set of available objects. Continuing a consistent list may not
     * be possible if the server configuration has changed or more than a few minutes
     * have passed. The resourceVersion field returned when using this continue value
     * will be identical to the value in the first response, unless you have received
     * this token from an error message.
     */
    private string|null $continue = null;

    /**
     * remainingItemCount is the number of subsequent items in the list which are not
     * included in this list response. If the list request contained label or field
     * selectors, then the number of remaining items is unknown and the field will be
     * left unset and omitted during serialization. If the list is complete (either
     * because it is not chunking or because this is the last chunk), then there are no
     * more remaining items and this field will be left unset and omitted during
     * serialization. Servers older than v1.15 do not set this field. The intended use
     * of the remainingItemCount is *estimating* the size of a collection. Clients
     * should not rely on the remainingItemCount to be set or to be exact.
     */
    private int|null $remainingItemCount = null;

    /**
     * String that identifies the server's internal version of this object that can be
     * used by clients to determine when objects have changed. Value must be treated as
     * opaque by clients and passed unmodified back to the server. Populated by the
     * system. Read-only. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#concurrency-control-and-consistency
     */
    private string|null $resourceVersion = null;

    /**
     * Deprecated: selfLink is a legacy read-only field that is no longer populated by
     * the system.
     */
    private string|null $selfLink = null;

    public function __construct()
    {
    }

    public function getContinue(): string|null
    {
        return $this->continue;
    }

    public function getRemainingItemCount(): int|null
    {
        return $this->remainingItemCount;
    }

    public function getResourceVersion(): string|null
    {
        return $this->resourceVersion;
    }

    public function getSelfLink(): string|null
    {
        return $this->selfLink;
    }

    public function setContinue(string $continue): self
    {
        $this->continue = $continue;

        return $this;
    }

    public function setRemainingItemCount(int $remainingItemCount): self
    {
        $this->remainingItemCount = $remainingItemCount;

        return $this;
    }

    public function setResourceVersion(string $resourceVersion): self
    {
        $this->resourceVersion = $resourceVersion;

        return $this;
    }

    public function setSelfLink(string $selfLink): self
    {
        $this->selfLink = $selfLink;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'continue' => $this->continue,
            'remainingItemCount' => $this->remainingItemCount,
            'resourceVersion' => $this->resourceVersion,
            'selfLink' => $this->selfLink,
        ];
    }
}
