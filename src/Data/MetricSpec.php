<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * MetricSpec specifies how to scale based on a single metric (only `type` and one
 * other matching field should be set at once).
 */
class MetricSpec implements JsonSerializable
{
    /**
     * containerResource refers to a resource metric (such as those specified in
     * requests and limits) known to Kubernetes describing a single container in each
     * pod of the current scale target (e.g. CPU or memory). Such metrics are built in
     * to Kubernetes, and have special scaling options on top of those available to
     * normal per-pod metrics using the "pods" source. This is an alpha feature and can
     * be enabled by the HPAContainerMetrics feature flag.
     */
    private ContainerResourceMetricSource|null $containerResource = null;

    /**
     * external refers to a global metric that is not associated with any Kubernetes
     * object. It allows autoscaling based on information coming from components
     * running outside of cluster (for example length of queue in cloud messaging
     * service, or QPS from loadbalancer running outside of cluster).
     */
    private ExternalMetricSource|null $external = null;

    /**
     * object refers to a metric describing a single kubernetes object (for example,
     * hits-per-second on an Ingress object).
     */
    private ObjectMetricSource|null $object = null;

    /**
     * pods refers to a metric describing each pod in the current scale target (for
     * example, transactions-processed-per-second).  The values will be averaged
     * together before being compared to the target value.
     */
    private PodsMetricSource|null $pods = null;

    /**
     * resource refers to a resource metric (such as those specified in requests and
     * limits) known to Kubernetes describing each pod in the current scale target
     * (e.g. CPU or memory). Such metrics are built in to Kubernetes, and have special
     * scaling options on top of those available to normal per-pod metrics using the
     * "pods" source.
     */
    private ResourceMetricSource|null $resource = null;

    /**
     * type is the type of metric source.  It should be one of "ContainerResource",
     * "External", "Object", "Pods" or "Resource", each mapping to a matching field in
     * the object. Note: "ContainerResource" type is available on when the feature-gate
     * HPAContainerMetrics is enabled
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getContainerResource(): ContainerResourceMetricSource|null
    {
        return $this->containerResource;
    }

    public function getExternal(): ExternalMetricSource|null
    {
        return $this->external;
    }

    public function getObject(): ObjectMetricSource|null
    {
        return $this->object;
    }

    public function getPods(): PodsMetricSource|null
    {
        return $this->pods;
    }

    public function getResource(): ResourceMetricSource|null
    {
        return $this->resource;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setContainerResource(ContainerResourceMetricSource $containerResource): self
    {
        $this->containerResource = $containerResource;

        return $this;
    }

    public function setExternal(ExternalMetricSource $external): self
    {
        $this->external = $external;

        return $this;
    }

    public function setObject(ObjectMetricSource $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function setPods(PodsMetricSource $pods): self
    {
        $this->pods = $pods;

        return $this;
    }

    public function setResource(ResourceMetricSource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'containerResource' => $this->containerResource,
            'external' => $this->external,
            'object' => $this->object,
            'pods' => $this->pods,
            'resource' => $this->resource,
            'type' => $this->type,
        ];
    }
}
