<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ManagedFieldsEntry is a workflow-id, a FieldSet and the group version of the
 * resource that the fieldset applies to.
 */
class ManagedFieldsEntry implements JsonSerializable
{
    /**
     * APIVersion defines the version of this resource that this field set applies to.
     * The format is "group/version" just like the top-level APIVersion field. It is
     * necessary to track the version of a field set because it cannot be automatically
     * converted.
     */
    private string|null $apiVersion = null;

    /**
     * FieldsType is the discriminator for the different fields format and version.
     * There is currently only one possible value: "FieldsV1"
     */
    private string|null $fieldsType = null;

    /**
     * FieldsV1 holds the first JSON version format as described in the "FieldsV1"
     * type.
     */
    private FieldsV1 $fieldsV1;

    /**
     * Manager is an identifier of the workflow managing these fields.
     */
    private string|null $manager = null;

    /**
     * Operation is the type of operation which lead to this ManagedFieldsEntry being
     * created. The only valid values for this field are 'Apply' and 'Update'.
     */
    private string|null $operation = null;

    /**
     * Time is timestamp of when these fields were set. It should always be empty if
     * Operation is 'Apply'
     */
    private DateTimeInterface|null $time = null;

    public function __construct()
    {
        $this->fieldsV1 = new FieldsV1();
    }

    public function fieldsV1(): FieldsV1
    {
        return $this->fieldsV1;
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getFieldsType(): string|null
    {
        return $this->fieldsType;
    }

    public function getManager(): string|null
    {
        return $this->manager;
    }

    public function getOperation(): string|null
    {
        return $this->operation;
    }

    public function getTime(): DateTimeInterface|null
    {
        return $this->time;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setFieldsType(string $fieldsType): self
    {
        $this->fieldsType = $fieldsType;

        return $this;
    }

    public function setManager(string $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function setOperation(string $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function setTime(DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => $this->apiVersion,
            'fieldsType' => $this->fieldsType,
            'fieldsV1' => $this->fieldsV1,
            'manager' => $this->manager,
            'operation' => $this->operation,
            'time' => $this->time,
        ];
    }
}
