<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * NamespaceSpec describes the attributes on a Namespace.
 */
class NamespaceSpec implements JsonSerializable
{
    /**
     * Finalizers is an opaque list of values that must be empty to permanently remove
     * object from storage. More info:
     * https://kubernetes.io/docs/tasks/administer-cluster/namespaces/
     */
    private StringList $finalizers;

    public function __construct()
    {
        $this->finalizers = new StringList();
    }

    public function finalizers(): StringList
    {
        return $this->finalizers;
    }

    public function jsonSerialize()
    {
        return [
            'finalizers' => $this->finalizers,
        ];
    }
}
