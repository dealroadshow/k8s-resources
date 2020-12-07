<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\AllowedCSIDriverList;
use Dealroadshow\K8S\Data\Collection\AllowedFlexVolumeList;
use Dealroadshow\K8S\Data\Collection\AllowedHostPathList;
use Dealroadshow\K8S\Data\Collection\HostPortRangeList;
use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * PodSecurityPolicySpec defines the policy enforced. Deprecated: use
 * PodSecurityPolicySpec from policy API Group instead.
 */
class PodSecurityPolicySpec implements JsonSerializable
{
    /**
     * allowPrivilegeEscalation determines if a pod can request to allow privilege
     * escalation. If unspecified, defaults to true.
     */
    private bool|null $allowPrivilegeEscalation = null;

    /**
     * AllowedCSIDrivers is a whitelist of inline CSI drivers that must be explicitly
     * set to be embedded within a pod spec. An empty value indicates that any CSI
     * driver can be used for inline ephemeral volumes.
     */
    private AllowedCSIDriverList $allowedCSIDrivers;

    /**
     * allowedCapabilities is a list of capabilities that can be requested to add to
     * the container. Capabilities in this field may be added at the pod author's
     * discretion. You must not list a capability in both allowedCapabilities and
     * requiredDropCapabilities.
     */
    private StringList $allowedCapabilities;

    /**
     * allowedFlexVolumes is a whitelist of allowed Flexvolumes.  Empty or nil
     * indicates that all Flexvolumes may be used.  This parameter is effective only
     * when the usage of the Flexvolumes is allowed in the "volumes" field.
     */
    private AllowedFlexVolumeList $allowedFlexVolumes;

    /**
     * allowedHostPaths is a white list of allowed host paths. Empty indicates that all
     * host paths may be used.
     */
    private AllowedHostPathList $allowedHostPaths;

    /**
     * AllowedProcMountTypes is a whitelist of allowed ProcMountTypes. Empty or nil
     * indicates that only the DefaultProcMountType may be used. This requires the
     * ProcMountType feature flag to be enabled.
     */
    private StringList $allowedProcMountTypes;

    /**
     * allowedUnsafeSysctls is a list of explicitly allowed unsafe sysctls, defaults to
     * none. Each entry is either a plain sysctl name or ends in "*" in which case it
     * is considered as a prefix of allowed sysctls. Single * means all unsafe sysctls
     * are allowed. Kubelet has to whitelist all allowed unsafe sysctls explicitly to
     * avoid rejection.
     *
     * Examples: e.g. "foo/*" allows "foo/bar", "foo/baz", etc. e.g. "foo.*" allows
     * "foo.bar", "foo.baz", etc.
     */
    private StringList $allowedUnsafeSysctls;

    /**
     * defaultAddCapabilities is the default set of capabilities that will be added to
     * the container unless the pod spec specifically drops the capability.  You may
     * not list a capability in both defaultAddCapabilities and
     * requiredDropCapabilities. Capabilities added here are implicitly allowed, and
     * need not be included in the allowedCapabilities list.
     */
    private StringList $defaultAddCapabilities;

    /**
     * defaultAllowPrivilegeEscalation controls the default setting for whether a
     * process can gain more privileges than its parent process.
     */
    private bool|null $defaultAllowPrivilegeEscalation = null;

    /**
     * forbiddenSysctls is a list of explicitly forbidden sysctls, defaults to none.
     * Each entry is either a plain sysctl name or ends in "*" in which case it is
     * considered as a prefix of forbidden sysctls. Single * means all sysctls are
     * forbidden.
     *
     * Examples: e.g. "foo/*" forbids "foo/bar", "foo/baz", etc. e.g. "foo.*" forbids
     * "foo.bar", "foo.baz", etc.
     */
    private StringList $forbiddenSysctls;

    /**
     * fsGroup is the strategy that will dictate what fs group is used by the
     * SecurityContext.
     */
    private FSGroupStrategyOptions $fsGroup;

    /**
     * hostIPC determines if the policy allows the use of HostIPC in the pod spec.
     */
    private bool|null $hostIPC = null;

    /**
     * hostNetwork determines if the policy allows the use of HostNetwork in the pod
     * spec.
     */
    private bool|null $hostNetwork = null;

    /**
     * hostPID determines if the policy allows the use of HostPID in the pod spec.
     */
    private bool|null $hostPID = null;

    /**
     * hostPorts determines which host port ranges are allowed to be exposed.
     */
    private HostPortRangeList $hostPorts;

    /**
     * privileged determines if a pod can request to be run as privileged.
     */
    private bool|null $privileged = null;

    /**
     * readOnlyRootFilesystem when set to true will force containers to run with a read
     * only root file system.  If the container specifically requests to run with a
     * non-read only root file system the PSP should deny the pod. If set to false the
     * container may run with a read only root file system if it wishes but it will not
     * be forced to.
     */
    private bool|null $readOnlyRootFilesystem = null;

    /**
     * requiredDropCapabilities are the capabilities that will be dropped from the
     * container.  These are required to be dropped and cannot be added.
     */
    private StringList $requiredDropCapabilities;

    /**
     * RunAsGroup is the strategy that will dictate the allowable RunAsGroup values
     * that may be set. If this field is omitted, the pod's RunAsGroup can take any
     * value. This field requires the RunAsGroup feature gate to be enabled.
     */
    private RunAsGroupStrategyOptions|null $runAsGroup = null;

    /**
     * runAsUser is the strategy that will dictate the allowable RunAsUser values that
     * may be set.
     */
    private RunAsUserStrategyOptions $runAsUser;

    /**
     * runtimeClass is the strategy that will dictate the allowable RuntimeClasses for
     * a pod. If this field is omitted, the pod's runtimeClassName field is
     * unrestricted. Enforcement of this field depends on the RuntimeClass feature gate
     * being enabled.
     */
    private RuntimeClassStrategyOptions $runtimeClass;

    /**
     * seLinux is the strategy that will dictate the allowable labels that may be set.
     */
    private SELinuxStrategyOptions $seLinux;

    /**
     * supplementalGroups is the strategy that will dictate what supplemental groups
     * are used by the SecurityContext.
     */
    private SupplementalGroupsStrategyOptions $supplementalGroups;

    /**
     * volumes is a white list of allowed volume plugins. Empty indicates that no
     * volumes may be used. To allow all volumes you may use '*'.
     */
    private StringList $volumes;

    public function __construct(RunAsUserStrategyOptions $runAsUser, SELinuxStrategyOptions $seLinux)
    {
        $this->allowedCSIDrivers = new AllowedCSIDriverList();
        $this->allowedCapabilities = new StringList();
        $this->allowedFlexVolumes = new AllowedFlexVolumeList();
        $this->allowedHostPaths = new AllowedHostPathList();
        $this->allowedProcMountTypes = new StringList();
        $this->allowedUnsafeSysctls = new StringList();
        $this->defaultAddCapabilities = new StringList();
        $this->forbiddenSysctls = new StringList();
        $this->fsGroup = new FSGroupStrategyOptions();
        $this->hostPorts = new HostPortRangeList();
        $this->requiredDropCapabilities = new StringList();
        $this->runAsUser = $runAsUser;
        $this->runtimeClass = new RuntimeClassStrategyOptions();
        $this->seLinux = $seLinux;
        $this->supplementalGroups = new SupplementalGroupsStrategyOptions();
        $this->volumes = new StringList();
    }

    public function allowedCSIDrivers(): AllowedCSIDriverList
    {
        return $this->allowedCSIDrivers;
    }

    public function allowedCapabilities(): StringList
    {
        return $this->allowedCapabilities;
    }

    public function allowedFlexVolumes(): AllowedFlexVolumeList
    {
        return $this->allowedFlexVolumes;
    }

    public function allowedHostPaths(): AllowedHostPathList
    {
        return $this->allowedHostPaths;
    }

    public function allowedProcMountTypes(): StringList
    {
        return $this->allowedProcMountTypes;
    }

    public function allowedUnsafeSysctls(): StringList
    {
        return $this->allowedUnsafeSysctls;
    }

    public function defaultAddCapabilities(): StringList
    {
        return $this->defaultAddCapabilities;
    }

    public function forbiddenSysctls(): StringList
    {
        return $this->forbiddenSysctls;
    }

    public function fsGroup(): FSGroupStrategyOptions
    {
        return $this->fsGroup;
    }

    public function getAllowPrivilegeEscalation(): bool|null
    {
        return $this->allowPrivilegeEscalation;
    }

    public function getDefaultAllowPrivilegeEscalation(): bool|null
    {
        return $this->defaultAllowPrivilegeEscalation;
    }

    public function getHostIPC(): bool|null
    {
        return $this->hostIPC;
    }

    public function getHostNetwork(): bool|null
    {
        return $this->hostNetwork;
    }

    public function getHostPID(): bool|null
    {
        return $this->hostPID;
    }

    public function getPrivileged(): bool|null
    {
        return $this->privileged;
    }

    public function getReadOnlyRootFilesystem(): bool|null
    {
        return $this->readOnlyRootFilesystem;
    }

    public function getRunAsGroup(): RunAsGroupStrategyOptions|null
    {
        return $this->runAsGroup;
    }

    public function getRunAsUser(): RunAsUserStrategyOptions
    {
        return $this->runAsUser;
    }

    public function getSeLinux(): SELinuxStrategyOptions
    {
        return $this->seLinux;
    }

    public function hostPorts(): HostPortRangeList
    {
        return $this->hostPorts;
    }

    public function requiredDropCapabilities(): StringList
    {
        return $this->requiredDropCapabilities;
    }

    public function runtimeClass(): RuntimeClassStrategyOptions
    {
        return $this->runtimeClass;
    }

    public function setAllowPrivilegeEscalation(bool $allowPrivilegeEscalation): self
    {
        $this->allowPrivilegeEscalation = $allowPrivilegeEscalation;

        return $this;
    }

    public function setDefaultAllowPrivilegeEscalation(bool $defaultAllowPrivilegeEscalation): self
    {
        $this->defaultAllowPrivilegeEscalation = $defaultAllowPrivilegeEscalation;

        return $this;
    }

    public function setHostIPC(bool $hostIPC): self
    {
        $this->hostIPC = $hostIPC;

        return $this;
    }

    public function setHostNetwork(bool $hostNetwork): self
    {
        $this->hostNetwork = $hostNetwork;

        return $this;
    }

    public function setHostPID(bool $hostPID): self
    {
        $this->hostPID = $hostPID;

        return $this;
    }

    public function setPrivileged(bool $privileged): self
    {
        $this->privileged = $privileged;

        return $this;
    }

    public function setReadOnlyRootFilesystem(bool $readOnlyRootFilesystem): self
    {
        $this->readOnlyRootFilesystem = $readOnlyRootFilesystem;

        return $this;
    }

    public function setRunAsGroup(RunAsGroupStrategyOptions $runAsGroup): self
    {
        $this->runAsGroup = $runAsGroup;

        return $this;
    }

    public function setRunAsUser(RunAsUserStrategyOptions $runAsUser): self
    {
        $this->runAsUser = $runAsUser;

        return $this;
    }

    public function setSeLinux(SELinuxStrategyOptions $seLinux): self
    {
        $this->seLinux = $seLinux;

        return $this;
    }

    public function supplementalGroups(): SupplementalGroupsStrategyOptions
    {
        return $this->supplementalGroups;
    }

    public function volumes(): StringList
    {
        return $this->volumes;
    }

    public function jsonSerialize(): array
    {
        return [
            'allowPrivilegeEscalation' => $this->allowPrivilegeEscalation,
            'allowedCSIDrivers' => $this->allowedCSIDrivers,
            'allowedCapabilities' => $this->allowedCapabilities,
            'allowedFlexVolumes' => $this->allowedFlexVolumes,
            'allowedHostPaths' => $this->allowedHostPaths,
            'allowedProcMountTypes' => $this->allowedProcMountTypes,
            'allowedUnsafeSysctls' => $this->allowedUnsafeSysctls,
            'defaultAddCapabilities' => $this->defaultAddCapabilities,
            'defaultAllowPrivilegeEscalation' => $this->defaultAllowPrivilegeEscalation,
            'forbiddenSysctls' => $this->forbiddenSysctls,
            'fsGroup' => $this->fsGroup,
            'hostIPC' => $this->hostIPC,
            'hostNetwork' => $this->hostNetwork,
            'hostPID' => $this->hostPID,
            'hostPorts' => $this->hostPorts,
            'privileged' => $this->privileged,
            'readOnlyRootFilesystem' => $this->readOnlyRootFilesystem,
            'requiredDropCapabilities' => $this->requiredDropCapabilities,
            'runAsGroup' => $this->runAsGroup,
            'runAsUser' => $this->runAsUser,
            'runtimeClass' => $this->runtimeClass,
            'seLinux' => $this->seLinux,
            'supplementalGroups' => $this->supplementalGroups,
            'volumes' => $this->volumes,
        ];
    }
}
