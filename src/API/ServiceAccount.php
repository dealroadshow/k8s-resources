<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\LocalObjectReferenceList;
use Dealroadshow\K8S\Data\Collection\ObjectReferenceList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * ServiceAccount binds together: * a name, understood by users, and perhaps by
 * peripheral systems, for an identity * a principal that can be authenticated and
 * authorized * a set of secrets
 */
class ServiceAccount implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'ServiceAccount';

    /**
     * AutomountServiceAccountToken indicates whether pods running as this service
     * account should have an API token automatically mounted. Can be overridden at the
     * pod level.
     *
     * @var bool|null
     */
    private ?bool $automountServiceAccountToken = null;

    /**
     * ImagePullSecrets is a list of references to secrets in the same namespace to use
     * for pulling any images in pods that reference this ServiceAccount.
     * ImagePullSecrets are distinct from Secrets because Secrets can be mounted in the
     * pod, but ImagePullSecrets are only accessed by the kubelet. More info:
     * https://kubernetes.io/docs/concepts/containers/images/#specifying-imagepullsecrets-on-a-pod
     */
    private LocalObjectReferenceList $imagePullSecrets;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Secrets is the list of secrets allowed to be used by pods running using this
     * ServiceAccount. More info:
     * https://kubernetes.io/docs/concepts/configuration/secret
     */
    private ObjectReferenceList $secrets;

    public function __construct()
    {
        $this->imagePullSecrets = new LocalObjectReferenceList();
        $this->metadata = new ObjectMeta();
        $this->secrets = new ObjectReferenceList();
    }

    /**
     * @return bool|null
     */
    public function getAutomountServiceAccountToken(): ?bool
    {
        return $this->automountServiceAccountToken;
    }

    public function imagePullSecrets(): LocalObjectReferenceList
    {
        return $this->imagePullSecrets;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function secrets(): ObjectReferenceList
    {
        return $this->secrets;
    }

    public function setAutomountServiceAccountToken(bool $automountServiceAccountToken): self
    {
        $this->automountServiceAccountToken = $automountServiceAccountToken;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'automountServiceAccountToken' => $this->automountServiceAccountToken,
            'imagePullSecrets' => $this->imagePullSecrets,
            'metadata' => $this->metadata,
            'secrets' => $this->secrets,
        ];
    }
}
