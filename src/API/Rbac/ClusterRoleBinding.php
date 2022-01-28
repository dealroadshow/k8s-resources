<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Rbac;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\SubjectList;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\RoleRef;

/**
 * ClusterRoleBinding references a ClusterRole, but not contain it.  It can
 * reference a ClusterRole in the global namespace, and adds who information via
 * Subject.
 */
class ClusterRoleBinding implements APIResourceInterface
{
    public const API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const KIND = 'ClusterRoleBinding';

    /**
     * Standard object's metadata.
     */
    private ObjectMeta $metadata;

    /**
     * RoleRef can only reference a ClusterRole in the global namespace. If the RoleRef
     * cannot be resolved, the Authorizer must return an error.
     */
    private RoleRef $roleRef;

    /**
     * Subjects holds references to the objects the role applies to.
     */
    private SubjectList $subjects;

    public function __construct(RoleRef $roleRef)
    {
        $this->metadata = new ObjectMeta();
        $this->roleRef = $roleRef;
        $this->subjects = new SubjectList();
    }

    public function getRoleRef(): RoleRef
    {
        return $this->roleRef;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setRoleRef(RoleRef $roleRef): self
    {
        $this->roleRef = $roleRef;

        return $this;
    }

    public function subjects(): SubjectList
    {
        return $this->subjects;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'roleRef' => $this->roleRef,
            'subjects' => $this->subjects,
        ];
    }
}
