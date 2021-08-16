<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\DateTimeInterface;
use Dealroadshow\K8S\Data\EventSeries;
use Dealroadshow\K8S\Data\EventSource;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ObjectReference;

/**
 * Event is a report of an event somewhere in the cluster.  Events have a limited
 * retention time and triggers and messages may evolve with time.  Event consumers
 * should not rely on the timing of an event with a given Reason reflecting a
 * consistent underlying trigger, or the continued existence of events with that
 * Reason.  Events should be treated as informative, best-effort, supplemental
 * data.
 */
class Event implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'Event';

    /**
     * What action was taken/failed regarding to the Regarding object.
     */
    private string|null $action = null;

    /**
     * The number of times this event has occurred.
     */
    private int|null $count = null;

    /**
     * Time when this Event was first observed.
     */
    private DateTimeInterface|null $eventTime = null;

    /**
     * The time at which the event was first recorded. (Time of server receipt is in
     * TypeMeta.)
     */
    private DateTimeInterface|null $firstTimestamp = null;

    /**
     * The object that this event is about.
     */
    private ObjectReference $involvedObject;

    /**
     * The time at which the most recent occurrence of this event was recorded.
     */
    private DateTimeInterface|null $lastTimestamp = null;

    /**
     * A human-readable description of the status of this operation.
     */
    private string|null $message = null;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * This should be a short, machine understandable string that gives the reason for
     * the transition into the object's current status.
     */
    private string|null $reason = null;

    /**
     * Optional secondary object for more complex actions.
     */
    private ObjectReference $related;

    /**
     * Name of the controller that emitted this Event, e.g. `kubernetes.io/kubelet`.
     */
    private string|null $reportingComponent = null;

    /**
     * ID of the controller instance, e.g. `kubelet-xyzf`.
     */
    private string|null $reportingInstance = null;

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
     */
    private string|null $type = null;

    public function __construct()
    {
        $this->involvedObject = new ObjectReference();
        $this->metadata = new ObjectMeta();
        $this->related = new ObjectReference();
        $this->series = new EventSeries();
        $this->source = new EventSource();
    }

    public function getAction(): string|null
    {
        return $this->action;
    }

    public function getCount(): int|null
    {
        return $this->count;
    }

    public function getEventTime(): DateTimeInterface|null
    {
        return $this->eventTime;
    }

    public function getFirstTimestamp(): DateTimeInterface|null
    {
        return $this->firstTimestamp;
    }

    public function getLastTimestamp(): DateTimeInterface|null
    {
        return $this->lastTimestamp;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function getReportingComponent(): string|null
    {
        return $this->reportingComponent;
    }

    public function getReportingInstance(): string|null
    {
        return $this->reportingInstance;
    }

    public function getType(): string|null
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

    public function setEventTime(DateTimeInterface $eventTime): self
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    public function setFirstTimestamp(DateTimeInterface $firstTimestamp): self
    {
        $this->firstTimestamp = $firstTimestamp;

        return $this;
    }

    public function setLastTimestamp(DateTimeInterface $lastTimestamp): self
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

    public function jsonSerialize(): array
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
