<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\Time;
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
     *
     * @var string|null
     */
    private ?string $apiVersion = null;

    /**
     * FieldsType is the discriminator for the different fields format and version.
     * There is currently only one possible value: "FieldsV1"
     *
     * @var string|null
     */
    private ?string $fieldsType = null;

    /**
     * FieldsV1 holds the first JSON version format as described in the "FieldsV1"
     * type.
     */
    private FieldsV1 $fieldsV1;

    /**
     * Manager is an identifier of the workflow managing these fields.
     *
     * @var string|null
     */
    private ?string $manager = null;

    /**
     * Operation is the type of operation which lead to this ManagedFieldsEntry being
     * created. The only valid values for this field are 'Apply' and 'Update'.
     *
     * @var string|null
     */
    private ?string $operation = null;

    /**
     * Time is timestamp of when these fields were set. It should always be empty if
     * Operation is 'Apply'
     *
     * @var Time|null
     */
    private ?Time $time = null;

    public function __construct()
    {
        $this->fieldsV1 = new FieldsV1();
    }

    public function fieldsV1(): FieldsV1
    {
        return $this->fieldsV1;
    }

    /**
     * @return string|null
     */
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    /**
     * @return string|null
     */
    public function getFieldsType(): ?string
    {
        return $this->fieldsType;
    }

    /**
     * @return string|null
     */
    public function getManager(): ?string
    {
        return $this->manager;
    }

    /**
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * @return Time|null
     */
    public function getTime(): ?Time
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

    public function setTime(Time $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function jsonSerialize()
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
