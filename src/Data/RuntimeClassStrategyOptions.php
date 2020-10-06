<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * RuntimeClassStrategyOptions define the strategy that will dictate the allowable
 * RuntimeClasses for a pod.
 */
class RuntimeClassStrategyOptions implements JsonSerializable
{
    /**
     * allowedRuntimeClassNames is a whitelist of RuntimeClass names that may be
     * specified on a pod. A value of "*" means that any RuntimeClass name is allowed,
     * and must be the only item in the list. An empty list requires the
     * RuntimeClassName field to be unset.
     */
    private StringList $allowedRuntimeClassNames;

    /**
     * defaultRuntimeClassName is the default RuntimeClassName to set on the pod. The
     * default MUST be allowed by the allowedRuntimeClassNames list. A value of nil
     * does not mutate the Pod.
     *
     * @var string|null
     */
    private ?string $defaultRuntimeClassName = null;

    public function __construct()
    {
        $this->allowedRuntimeClassNames = new StringList();
    }

    public function allowedRuntimeClassNames(): StringList
    {
        return $this->allowedRuntimeClassNames;
    }

    /**
     * @return string|null
     */
    public function getDefaultRuntimeClassName(): ?string
    {
        return $this->defaultRuntimeClassName;
    }

    public function setDefaultRuntimeClassName(string $defaultRuntimeClassName): self
    {
        $this->defaultRuntimeClassName = $defaultRuntimeClassName;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'allowedRuntimeClassNames' => $this->allowedRuntimeClassNames,
            'defaultRuntimeClassName' => $this->defaultRuntimeClassName,
        ];
    }
}
