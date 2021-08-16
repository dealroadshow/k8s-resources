<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * WindowsSecurityContextOptions contain Windows-specific options and credentials.
 */
class WindowsSecurityContextOptions implements JsonSerializable
{
    /**
     * GMSACredentialSpec is where the GMSA admission webhook
     * (https://github.com/kubernetes-sigs/windows-gmsa) inlines the contents of the
     * GMSA credential spec named by the GMSACredentialSpecName field.
     */
    private string|null $gmsaCredentialSpec = null;

    /**
     * GMSACredentialSpecName is the name of the GMSA credential spec to use.
     */
    private string|null $gmsaCredentialSpecName = null;

    /**
     * HostProcess determines if a container should be run as a 'Host Process'
     * container. This field is alpha-level and will only be honored by components that
     * enable the WindowsHostProcessContainers feature flag. Setting this field without
     * the feature flag will result in errors when validating the Pod. All of a Pod's
     * containers must have the same effective HostProcess value (it is not allowed to
     * have a mix of HostProcess containers and non-HostProcess containers).  In
     * addition, if HostProcess is true then HostNetwork must also be set to true.
     */
    private bool|null $hostProcess = null;

    /**
     * The UserName in Windows to run the entrypoint of the container process. Defaults
     * to the user specified in image metadata if unspecified. May also be set in
     * PodSecurityContext. If set in both SecurityContext and PodSecurityContext, the
     * value specified in SecurityContext takes precedence.
     */
    private string|null $runAsUserName = null;

    public function __construct()
    {
    }

    public function getGmsaCredentialSpec(): string|null
    {
        return $this->gmsaCredentialSpec;
    }

    public function getGmsaCredentialSpecName(): string|null
    {
        return $this->gmsaCredentialSpecName;
    }

    public function getHostProcess(): bool|null
    {
        return $this->hostProcess;
    }

    public function getRunAsUserName(): string|null
    {
        return $this->runAsUserName;
    }

    public function setGmsaCredentialSpec(string $gmsaCredentialSpec): self
    {
        $this->gmsaCredentialSpec = $gmsaCredentialSpec;

        return $this;
    }

    public function setGmsaCredentialSpecName(string $gmsaCredentialSpecName): self
    {
        $this->gmsaCredentialSpecName = $gmsaCredentialSpecName;

        return $this;
    }

    public function setHostProcess(bool $hostProcess): self
    {
        $this->hostProcess = $hostProcess;

        return $this;
    }

    public function setRunAsUserName(string $runAsUserName): self
    {
        $this->runAsUserName = $runAsUserName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'gmsaCredentialSpec' => $this->gmsaCredentialSpec,
            'gmsaCredentialSpecName' => $this->gmsaCredentialSpecName,
            'hostProcess' => $this->hostProcess,
            'runAsUserName' => $this->runAsUserName,
        ];
    }
}
