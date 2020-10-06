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
     * GMSA credential spec named by the GMSACredentialSpecName field. This field is
     * alpha-level and is only honored by servers that enable the WindowsGMSA feature
     * flag.
     *
     * @var string|null
     */
    private ?string $gmsaCredentialSpec = null;

    /**
     * GMSACredentialSpecName is the name of the GMSA credential spec to use. This
     * field is alpha-level and is only honored by servers that enable the WindowsGMSA
     * feature flag.
     *
     * @var string|null
     */
    private ?string $gmsaCredentialSpecName = null;

    /**
     * The UserName in Windows to run the entrypoint of the container process. Defaults
     * to the user specified in image metadata if unspecified. May also be set in
     * PodSecurityContext. If set in both SecurityContext and PodSecurityContext, the
     * value specified in SecurityContext takes precedence. This field is alpha-level
     * and it is only honored by servers that enable the WindowsRunAsUserName feature
     * flag.
     *
     * @var string|null
     */
    private ?string $runAsUserName = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getGmsaCredentialSpec(): ?string
    {
        return $this->gmsaCredentialSpec;
    }

    /**
     * @return string|null
     */
    public function getGmsaCredentialSpecName(): ?string
    {
        return $this->gmsaCredentialSpecName;
    }

    /**
     * @return string|null
     */
    public function getRunAsUserName(): ?string
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

    public function setRunAsUserName(string $runAsUserName): self
    {
        $this->runAsUserName = $runAsUserName;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'gmsaCredentialSpec' => $this->gmsaCredentialSpec,
            'gmsaCredentialSpecName' => $this->gmsaCredentialSpecName,
            'runAsUserName' => $this->runAsUserName,
        ];
    }
}
