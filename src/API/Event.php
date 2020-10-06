<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\EventSeries;
use Dealroadshow\K8S\Data\EventSource;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ObjectReference;
use Dealroadshow\K8S\ValueObject\MicroTime;
use Dealroadshow\K8S\ValueObject\Time;

/**
 * Event is a report of an event somewhere in the cluster.
 */
class Event implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'Event';

    /**
     * What action was taken/failed regarding to the Regarding object.
     *
     * @var string|null
     */
    private ?string $action = null;

    /**
     * The number of times this event has occurred.
     *
     * @var int|null
     */
    private ?int $count = null;

    /**
     * Time when this Event was first observed.
     *
     * @var MicroTime|null
     */
    private ?MicroTime $eventTime = null;

    /**
     * The time at which the event was first recorded. (Time of server receipt is in
     * TypeMeta.)
     *
     * @var Time|null
     */
    private ?Time $firstTimestamp = null;

    /**
     * The object that this event is about.
     */
    private ObjectReference $involvedObject;

    /**
     * The time at which the most recent occurrence of this event was recorded.
     *
     * @var Time|null
     */
    private ?Time $lastTimestamp = null;

    /**
     * A human-readable description of the status of this operation.
     *
     * @var string|null
     */
    private ?string $message = null;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * This should be a short, machine understandable string that gives the reason for
     * the transition into the object's current status.
     *
     * @var string|null
     */
    private ?string $reason = null;

    /**
     * Optional secondary object for more complex actions.
     */
    private ObjectReference $related;

    /**
     * Name of the controller that emitted this Event, e.g. `kubernetes.io/kubelet`.
     *
     * @var string|null
     */
    private ?string $reportingComponent = null;

    /**
     * ID of the controller instance, e.g. `kubelet-xyzf`.
     *
     * @var string|null
     */
    private ?string $reportingInstance = null;

    /**
     * Data about the Event series this event represents or nil if it's a singleton
     * Event.
     */
    private EventSeries $series;

    /**
     * The component reporting this event. Should be a short machine understandable
     * string.
     */
    private EventSource $source;

    /**
     * Type of this event (Normal, Warning), new types could be added in the future
     *
     * @var string|null
     */
    private ?string $type = null;

    public function __construct()
    {
        $this->involvedObject = new ObjectReference();
        $this->metadata = new ObjectMeta();
        $this->related = new ObjectReference();
        $this->series = new EventSeries();
        $this->source = new EventSource();
    }

    /**
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @return MicroTime|null
     */
    public function getEventTime(): ?MicroTime
    {
        return $this->eventTime;
    }

    /**
     * @return Time|null
     */
    public function getFirstTimestamp(): ?Time
    {
        return $this->firstTimestamp;
    }

    /**
     * @return Time|null
     */
    public function getLastTimestamp(): ?Time
    {
        return $this->lastTimestamp;
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

    /**
     * @return string|null
     */
    public function getReportingComponent(): ?string
    {
        return $this->reportingComponent;
    }

    /**
     * @return string|null
     */
    public function getReportingInstance(): ?string
    {
        return $this->reportingInstance;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function involvedObject(): ObjectReference
    {
        return $this->involvedObject;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function related(): ObjectReference
    {
        return $this->related;
    }

    public function series(): EventSeries
    {
        return $this->series;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function setEventTime(MicroTime $eventTime): self
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    public function setFirstTimestamp(Time $firstTimestamp): self
    {
        $this->firstTimestamp = $firstTimestamp;

        return $this;
    }

    public function setLastTimestamp(Time $lastTimestamp): self
    {
        $this->lastTimestamp = $lastTimestamp;

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

    public function setReportingComponent(string $reportingComponent): self
    {
        $this->reportingComponent = $reportingComponent;

        return $this;
    }

    public function setReportingInstance(string $reportingInstance): self
    {
        $this->reportingInstance = $reportingInstance;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function source(): EventSource
    {
        return $this->source;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'action' => $this->action,
            'count' => $this->count,
            'eventTime' => $this->eventTime,
            'firstTimestamp' => $this->firstTimestamp,
            'involvedObject' => $this->involvedObject,
            'lastTimestamp' => $this->lastTimestamp,
            'message' => $this->message,
            'metadata' => $this->metadata,
            'reason' => $this->reason,
            'related' => $this->related,
            'reportingComponent' => $this->reportingComponent,
            'reportingInstance' => $this->reportingInstance,
            'series' => $this->series,
            'source' => $this->source,
            'type' => $this->type,
        ];
    }
}
