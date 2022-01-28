<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SecurityContext holds security configuration that will be applied to a
 * container. Some fields are present in both SecurityContext and
 * PodSecurityContext.  When both are set, the values in SecurityContext take
 * precedence.
 */
class SecurityContext implements JsonSerializable
{
    /**
     * AllowPrivilegeEscalation controls whether a process can gain more privileges
     * than its parent process. This bool directly controls if the no_new_privs flag
     * will be set on the container process. AllowPrivilegeEscalation is true always
     * when the container is: 1) run as Privileged 2) has CAP_SYS_ADMIN
     */
    private bool|null $allowPrivilegeEscalation = null;

    /**
     * The capabilities to add/drop when running containers. Defaults to the default
     * set of capabilities granted by the container runtime.
     */
    private Capabilities $capabilities;

    /**
     * Run container in privileged mode. Processes in privileged containers are
     * essentially equivalent to root on the host. Defaults to false.
     */
    private bool|null $privileged = null;

    /**
     * procMount denotes the type of proc mount to use for the containers. The default
     * is DefaultProcMount which uses the container runtime defaults for readonly paths
     * and masked paths. This requires the ProcMountType feature flag to be enabled.
     */
    private string|null $procMount = null;

    /**
     * Whether this container has a read-only root filesystem. Default is false.
     */
    private bool|null $readOnlyRootFilesystem = null;

    /**
     * The GID to run the entrypoint of the container process. Uses runtime default if
     * unset. May also be set in PodSecurityContext.  If set in both SecurityContext
     * and PodSecurityContext, the value specified in SecurityContext takes precedence.
     */
    private int|null $runAsGroup = null;

    /**
     * Indicates that the container must run as a non-root user. If true, the Kubelet
     * will validate the image at runtime to ensure that it does not run as UID 0
     * (root) and fail to start the container if it does. If unset or false, no such
     * validation will be performed. May also be set in PodSecurityContext.  If set in
     * both SecurityContext and PodSecurityContext, the value specified in
     * SecurityContext takes precedence.
     */
    private bool|null $runAsNonRoot = null;

    /**
     * The UID to run the entrypoint of the container process. Defaults to user
     * specified in image metadata if unspecified. May also be set in
     * PodSecurityContext.  If set in both SecurityContext and PodSecurityContext, the
     * value specified in SecurityContext takes precedence.
     */
    private int|null $runAsUser = null;

    /**
     * The SELinux context to be applied to the container. If unspecified, the
     * container runtime will allocate a random SELinux context for each container.
     * May also be set in PodSecurityContext.  If set in both SecurityContext and
     * PodSecurityContext, the value specified in SecurityContext takes precedence.
     */
    private SELinuxOptions $seLinuxOptions;

    /**
     * The seccomp options to use by this container. If seccomp options are provided at
     * both the pod & container level, the container options override the pod options.
     */
    private SeccompProfile|null $seccompProfile = null;

    /**
     * The Windows specific settings applied to all containers. If unspecified, the
     * options from the PodSecurityContext will be used. If set in both SecurityContext
     * and PodSecurityContext, the value specified in SecurityContext takes precedence.
     */
    private WindowsSecurityContextOptions $windowsOptions;

    public function __construct()
    {
        $this->capabilities = new Capabilities();
        $this->seLinuxOptions = new SELinuxOptions();
        $this->windowsOptions = new WindowsSecurityContextOptions();
    }

    public function capabilities(): Capabilities
    {
        return $this->capabilities;
    }

    public function getAllowPrivilegeEscalation(): bool|null
    {
        return $this->allowPrivilegeEscalation;
    }

    public function getPrivileged(): bool|null
    {
        return $this->privileged;
    }

    public function getProcMount(): string|null
    {
        return $this->procMount;
    }

    public function getReadOnlyRootFilesystem(): bool|null
    {
        return $this->readOnlyRootFilesystem;
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

    public function getSeccompProfile(): SeccompProfile|null
    {
        return $this->seccompProfile;
    }

    public function seLinuxOptions(): SELinuxOptions
    {
        return $this->seLinuxOptions;
    }

    public function setAllowPrivilegeEscalation(bool $allowPrivilegeEscalation): self
    {
        $this->allowPrivilegeEscalation = $allowPrivilegeEscalation;

        return $this;
    }

    public function setPrivileged(bool $privileged): self
    {
        $this->privileged = $privileged;

        return $this;
    }

    public function setProcMount(string $procMount): self
    {
        $this->procMount = $procMount;

        return $this;
    }

    public function setReadOnlyRootFilesystem(bool $readOnlyRootFilesystem): self
    {
        $this->readOnlyRootFilesystem = $readOnlyRootFilesystem;

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

    public function setSeccompProfile(SeccompProfile $seccompProfile): self
    {
        $this->seccompProfile = $seccompProfile;

        return $this;
    }

    public function windowsOptions(): WindowsSecurityContextOptions
    {
        return $this->windowsOptions;
    }

    public function jsonSerialize(): array
    {
        return [
            'allowPrivilegeEscalation' => $this->allowPrivilegeEscalation,
            'capabilities' => $this->capabilities,
            'privileged' => $this->privileged,
            'procMount' => $this->procMount,
            'readOnlyRootFilesystem' => $this->readOnlyRootFilesystem,
            'runAsGroup' => $this->runAsGroup,
            'runAsNonRoot' => $this->runAsNonRoot,
            'runAsUser' => $this->runAsUser,
            'seLinuxOptions' => $this->seLinuxOptions,
            'seccompProfile' => $this->seccompProfile,
            'windowsOptions' => $this->windowsOptions,
        ];
    }
}
