<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\IntList;
use Dealroadshow\K8S\Data\Collection\SysctlList;
use JsonSerializable;

/**
 * PodSecurityContext holds pod-level security attributes and common container
 * settings. Some fields are also present in container.securityContext.  Field
 * values of container.securityContext take precedence over field values of
 * PodSecurityContext.
 */
class PodSecurityContext implements JsonSerializable
{
    /**
     * A special supplemental group that applies to all containers in a pod. Some
     * volume types allow the Kubelet to change the ownership of that volume to be
     * owned by the pod:
     *
     * 1. The owning GID will be the FSGroup 2. The setgid bit is set (new files
     * created in the volume will be owned by FSGroup) 3. The permission bits are OR'd
     * with rw-rw----
     *
     * If unset, the Kubelet will not modify the ownership and permissions of any
     * volume.
     */
    private int|null $fsGroup = null;

    /**
     * The GID to run the entrypoint of the container process. Uses runtime default if
     * unset. May also be set in SecurityContext.  If set in both SecurityContext and
     * PodSecurityContext, the value specified in SecurityContext takes precedence for
     * that container.
     */
    private int|null $runAsGroup = null;

    /**
     * Indicates that the container must run as a non-root user. If true, the Kubelet
     * will validate the image at runtime to ensure that it does not run as UID 0
     * (root) and fail to start the container if it does. If unset or false, no such
     * validation will be performed. May also be set in SecurityContext.  If set in
     * both SecurityContext and PodSecurityContext, the value specified in
     * SecurityContext takes precedence.
     */
    private bool|null $runAsNonRoot = null;

    /**
     * The UID to run the entrypoint of the container process. Defaults to user
     * specified in image metadata if unspecified. May also be set in SecurityContext.
     * If set in both SecurityContext and PodSecurityContext, the value specified in
     * SecurityContext takes precedence for that container.
     */
    private int|null $runAsUser = null;

    /**
     * The SELinux context to be applied to all containers. If unspecified, the
     * container runtime will allocate a random SELinux context for each container.
     * May also be set in SecurityContext.  If set in both SecurityContext and
     * PodSecurityContext, the value specified in SecurityContext takes precedence for
     * that container.
     */
    private SELinuxOptions $seLinuxOptions;

    /**
     * A list of groups applied to the first process run in each container, in addition
     * to the container's primary GID.  If unspecified, no groups will be added to any
     * container.
     */
    private IntList $supplementalGroups;

    /**
     * Sysctls hold a list of namespaced sysctls used for the pod. Pods with
     * unsupported sysctls (by the container runtime) might fail to launch.
     */
    private SysctlList $sysctls;

    /**
     * The Windows specific settings applied to all containers. If unspecified, the
     * options within a container's SecurityContext will be used. If set in both
     * SecurityContext and PodSecurityContext, the value specified in SecurityContext
     * takes precedence.
     */
    private WindowsSecurityContextOptions $windowsOptions;

    public function __construct()
    {
        $this->seLinuxOptions = new SELinuxOptions();
        $this->supplementalGroups = new IntList();
        $this->sysctls = new SysctlList();
        $this->windowsOptions = new WindowsSecurityContextOptions();
    }

    public function getFsGroup(): int|null
    {
        return $this->fsGroup;
    }

    public function getRunAsGroup(): int|null
    {
        return $this->runAsGroup;
    }

    public function getRunAsNonRoot(): bool|null
    {
        return $this->runAsNonRoot;
    }

    public function getRunAsUser(): int|null
    {
        return $this->runAsUser;
    }

    public function seLinuxOptions(): SELinuxOptions
    {
        return $this->seLinuxOptions;
    }

    public function setFsGroup(int $fsGroup): self
    {
        $this->fsGroup = $fsGroup;

        return $this;
    }

    public function setRunAsGroup(int $runAsGroup): self
    {
        $this->runAsGroup = $runAsGroup;

        return $this;
    }

    public function setRunAsNonRoot(bool $runAsNonRoot): self
    {
        $this->runAsNonRoot = $runAsNonRoot;

        return $this;
    }

    public function setRunAsUser(int $runAsUser): self
    {
        $this->runAsUser = $runAsUser;

        return $this;
    }

    public function supplementalGroups(): IntList
    {
        return $this->supplementalGroups;
    }

    public function sysctls(): SysctlList
    {
        return $this->sysctls;
    }

    public function windowsOptions(): WindowsSecurityContextOptions
    {
        return $this->windowsOptions;
    }

    public function jsonSerialize(): array
    {
        return [
            'fsGroup' => $this->fsGroup,
            'runAsGroup' => $this->runAsGroup,
            'runAsNonRoot' => $this->runAsNonRoot,
            'runAsUser' => $this->runAsUser,
            'seLinuxOptions' => $this->seLinuxOptions,
            'supplementalGroups' => $this->supplementalGroups,
            'sysctls' => $this->sysctls,
            'windowsOptions' => $this->windowsOptions,
        ];
    }
}
