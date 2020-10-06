<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * CustomResourceDefinitionNames indicates the names to serve this
 * CustomResourceDefinition
 */
class CustomResourceDefinitionNames implements JsonSerializable
{
    /**
     * categories is a list of grouped resources this custom resource belongs to (e.g.
     * 'all'). This is published in API discovery documents, and used by clients to
     * support invocations like `kubectl get all`.
     */
    private StringList $categories;

    /**
     * kind is the serialized kind of the resource. It is normally CamelCase and
     * singular. Custom resource instances will use this value as the `kind` attribute
     * in API calls.
     */
    private string $kind;

    /**
     * listKind is the serialized kind of the list for this resource. Defaults to
     * "`kind`List".
     *
     * @var string|null
     */
    private ?string $listKind = null;

    /**
     * plural is the plural name of the resource to serve. The custom resources are
     * served under `/apis/<group>/<version>/.../<plural>`. Must match the name of the
     * CustomResourceDefinition (in the form `<names.plural>.<group>`). Must be all
     * lowercase.
     */
    private string $plural;

    /**
     * shortNames are short names for the resource, exposed in API discovery documents,
     * and used by clients to support invocations like `kubectl get <shortname>`. It
     * must be all lowercase.
     */
    private StringList $shortNames;

    /**
     * singular is the singular name of the resource. It must be all lowercase.
     * Defaults to lowercased `kind`.
     *
     * @var string|null
     */
    private ?string $singular = null;

    public function __construct(string $kind, string $plural)
    {
        $this->categories = new StringList();
        $this->kind = $kind;
        $this->plural = $plural;
        $this->shortNames = new StringList();
    }

    public function categories(): StringList
    {
        return $this->categories;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return string|null
     */
    public function getListKind(): ?string
    {
        return $this->listKind;
    }

    public function getPlural(): string
    {
        return $this->plural;
    }

    /**
     * @return string|null
     */
    public function getSingular(): ?string
    {
        return $this->singular;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setListKind(string $listKind): self
    {
        $this->listKind = $listKind;

        return $this;
    }

    public function setPlural(string $plural): self
    {
        $this->plural = $plural;

        return $this;
    }

    public function setSingular(string $singular): self
    {
        $this->singular = $singular;

        return $this;
    }

    public function shortNames(): StringList
    {
        return $this->shortNames;
    }

    public function jsonSerialize()
    {
        return [
            'categories' => $this->categories,
            'kind' => $this->kind,
            'listKind' => $this->listKind,
            'plural' => $this->plural,
            'shortNames' => $this->shortNames,
            'singular' => $this->singular,
        ];
    }
}
