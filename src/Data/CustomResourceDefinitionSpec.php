<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\CustomResourceDefinitionVersionList;
use JsonSerializable;

/**
 * CustomResourceDefinitionSpec describes how a user wants their resource to appear
 */
class CustomResourceDefinitionSpec implements JsonSerializable
{
    /**
     * conversion defines conversion settings for the CRD.
     */
    private CustomResourceConversion|null $conversion = null;

    /**
     * group is the API group of the defined custom resource. The custom resources are
     * served under `/apis/<group>/...`. Must match the name of the
     * CustomResourceDefinition (in the form `<names.plural>.<group>`).
     */
    private string $group;

    /**
     * names specify the resource and kind names for the custom resource.
     */
    private CustomResourceDefinitionNames $names;

    /**
     * preserveUnknownFields indicates that object fields which are not specified in
     * the OpenAPI schema should be preserved when persisting to storage. apiVersion,
     * kind, metadata and known fields inside metadata are always preserved. This field
     * is deprecated in favor of setting `x-preserve-unknown-fields` to true in
     * `spec.versions[*].schema.openAPIV3Schema`. See
     * https://kubernetes.io/docs/tasks/access-kubernetes-api/custom-resources/custom-resource-definitions/#pruning-versus-preserving-unknown-fields
     * for details.
     */
    private bool|null $preserveUnknownFields = null;

    /**
     * scope indicates whether the defined custom resource is cluster- or
     * namespace-scoped. Allowed values are `Cluster` and `Namespaced`. Default is
     * `Namespaced`.
     */
    private string $scope;

    /**
     * versions is the list of all API versions of the defined custom resource. Version
     * names are used to compute the order in which served versions are listed in API
     * discovery. If the version string is "kube-like", it will sort above non
     * "kube-like" version strings, which are ordered lexicographically. "Kube-like"
     * versions start with a "v", then are followed by a number (the major version),
     * then optionally the string "alpha" or "beta" and another number (the minor
     * version). These are sorted first by GA > beta > alpha (where GA is a version
     * with no suffix such as beta or alpha), and then by comparing major version, then
     * minor version. An example sorted list of versions: v10, v2, v1, v11beta2,
     * v10beta3, v3beta1, v12alpha1, v11alpha2, foo1, foo10.
     */
    private CustomResourceDefinitionVersionList $versions;

    public function __construct(string $group, CustomResourceDefinitionNames $names, string $scope)
    {
        $this->group = $group;
        $this->names = $names;
        $this->scope = $scope;
        $this->versions = new CustomResourceDefinitionVersionList();
    }

    public function getConversion(): CustomResourceConversion|null
    {
        return $this->conversion;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getNames(): CustomResourceDefinitionNames
    {
        return $this->names;
    }

    public function getPreserveUnknownFields(): bool|null
    {
        return $this->preserveUnknownFields;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function setConversion(CustomResourceConversion $conversion): self
    {
        $this->conversion = $conversion;

        return $this;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function setNames(CustomResourceDefinitionNames $names): self
    {
        $this->names = $names;

        return $this;
    }

    public function setPreserveUnknownFields(bool $preserveUnknownFields): self
    {
        $this->preserveUnknownFields = $preserveUnknownFields;

        return $this;
    }

    public function setScope(string $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    public function versions(): CustomResourceDefinitionVersionList
    {
        return $this->versions;
    }

    public function jsonSerialize(): array
    {
        return [
            'conversion' => $this->conversion,
            'group' => $this->group,
            'names' => $this->names,
            'preserveUnknownFields' => $this->preserveUnknownFields,
            'scope' => $this->scope,
            'versions' => $this->versions,
        ];
    }
}
