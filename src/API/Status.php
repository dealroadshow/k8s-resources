<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;
use Dealroadshow\K8S\Data\StatusDetails;

/**
 * Status is a return value for calls that don't return other objects.
 */
class Status implements APIResourceListInterface
{
    const API_VERSION = 'v1';
    const KIND = 'Status';

    /**
     * Suggested HTTP return code for this status, 0 if not set.
     *
     * @var int|null
     */
    private ?int $code = null;

    /**
     * Extended data associated with the reason.  Each reason may define its own
     * extended details. This field is optional and the data returned is not guaranteed
     * to conform to any schema except that defined by the reason type.
     */
    private StatusDetails $details;

    /**
     * A human-readable description of the status of this operation.
     *
     * @var string|null
     */
    private ?string $message = null;

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private ListMeta $metadata;

    /**
     * A machine-readable description of why this operation is in the "Failure" status.
     * If this value is empty there is no information available. A Reason clarifies an
     * HTTP status code but does not override it.
     *
     * @var string|null
     */
    private ?string $reason = null;

    public function __construct()
    {
        $this->details = new StatusDetails();
        $this->metadata = new ListMeta();
    }

    public function details(): StatusDetails
    {
        return $this->details;
    }

    /**
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'code' => $this->code,
            'details' => $this->details,
            'message' => $this->message,
            'metadata' => $this->metadata,
            'reason' => $this->reason,
        ];
    }
}
