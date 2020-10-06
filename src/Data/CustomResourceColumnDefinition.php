<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * CustomResourceColumnDefinition specifies a column for server side printing.
 */
class CustomResourceColumnDefinition implements JsonSerializable
{
    /**
     * description is a human readable description of this column.
     *
     * @var string|null
     */
    private ?string $description = null;

    /**
     * format is an optional OpenAPI type definition for this column. The 'name' format
     * is applied to the primary identifier column to assist in clients identifying
     * column is the resource name. See
     * https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md#data-types
     * for details.
     *
     * @var string|null
     */
    private ?string $format = null;

    /**
     * jsonPath is a simple JSON path (i.e. with array notation) which is evaluated
     * against each custom resource to produce the value for this column.
     */
    private string $jsonPath;

    /**
     * name is a human readable name for the column.
     */
    private string $name;

    /**
     * priority is an integer defining the relative importance of this column compared
     * to others. Lower numbers are considered higher priority. Columns that may be
     * omitted in limited space scenarios should be given a priority greater than 0.
     *
     * @var int|null
     */
    private ?int $priority = null;

    /**
     * type is an OpenAPI type definition for this column. See
     * https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md#data-types
     * for details.
     */
    private string $type;

    public function __construct(string $jsonPath, string $name, string $type)
    {
        $this->jsonPath = $jsonPath;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function getJsonPath(): string
    {
        return $this->jsonPath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function setJsonPath(string $jsonPath): self
    {
        $this->jsonPath = $jsonPath;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'description' => $this->description,
            'format' => $this->format,
            'jsonPath' => $this->jsonPath,
            'name' => $this->name,
            'priority' => $this->priority,
            'type' => $this->type,
        ];
    }
}
