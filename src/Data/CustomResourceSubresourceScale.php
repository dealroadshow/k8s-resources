<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CustomResourceSubresourceScale defines how to serve the scale subresource for
 * CustomResources.
 */
class CustomResourceSubresourceScale implements JsonSerializable
{
    /**
     * labelSelectorPath defines the JSON path inside of a custom resource that
     * corresponds to Scale `status.selector`. Only JSON paths without the array
     * notation are allowed. Must be a JSON Path under `.status` or `.spec`. Must be
     * set to work with HorizontalPodAutoscaler. The field pointed by this JSON path
     * must be a string field (not a complex selector struct) which contains a
     * serialized label selector in string form. More info:
     * https://kubernetes.io/docs/tasks/access-kubernetes-api/custom-resources/custom-resource-definitions#scale-subresource
     * If there is no value under the given path in the custom resource, the
     * `status.selector` value in the `/scale` subresource will default to the empty
     * string.
     *
     * @var string|null
     */
    private ?string $labelSelectorPath = null;

    /**
     * specReplicasPath defines the JSON path inside of a custom resource that
     * corresponds to Scale `spec.replicas`. Only JSON paths without the array notation
     * are allowed. Must be a JSON Path under `.spec`. If there is no value under the
     * given path in the custom resource, the `/scale` subresource will return an error
     * on GET.
     */
    private string $specReplicasPath;

    /**
     * statusReplicasPath defines the JSON path inside of a custom resource that
     * corresponds to Scale `status.replicas`. Only JSON paths without the array
     * notation are allowed. Must be a JSON Path under `.status`. If there is no value
     * under the given path in the custom resource, the `status.replicas` value in the
     * `/scale` subresource will default to 0.
     */
    private string $statusReplicasPath;

    public function __construct(string $specReplicasPath, string $statusReplicasPath)
    {
        $this->specReplicasPath = $specReplicasPath;
        $this->statusReplicasPath = $statusReplicasPath;
    }

    /**
     * @return string|null
     */
    public function getLabelSelectorPath(): ?string
    {
        return $this->labelSelectorPath;
    }

    public function getSpecReplicasPath(): string
    {
        return $this->specReplicasPath;
    }

    public function getStatusReplicasPath(): string
    {
        return $this->statusReplicasPath;
    }

    public function setLabelSelectorPath(string $labelSelectorPath): self
    {
        $this->labelSelectorPath = $labelSelectorPath;

        return $this;
    }

    public function setSpecReplicasPath(string $specReplicasPath): self
    {
        $this->specReplicasPath = $specReplicasPath;

        return $this;
    }

    public function setStatusReplicasPath(string $statusReplicasPath): self
    {
        $this->statusReplicasPath = $statusReplicasPath;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'labelSelectorPath' => $this->labelSelectorPath,
            'specReplicasPath' => $this->specReplicasPath,
            'statusReplicasPath' => $this->statusReplicasPath,
        ];
    }
}
