<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ContainerPortList;
use Dealroadshow\K8S\Data\Collection\EnvFromSourceList;
use Dealroadshow\K8S\Data\Collection\EnvVarList;
use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\VolumeDeviceList;
use Dealroadshow\K8S\Data\Collection\VolumeMountList;
use JsonSerializable;

/**
 * An EphemeralContainer is a container that may be added temporarily to an
 * existing pod for user-initiated activities such as debugging. Ephemeral
 * containers have no resource or scheduling guarantees, and they will not be
 * restarted when they exit or when a pod is removed or restarted. If an ephemeral
 * container causes a pod to exceed its resource allocation, the pod may be
 * evicted. Ephemeral containers may not be added by directly updating the pod
 * spec. They must be added via the pod's ephemeralcontainers subresource, and they
 * will appear in the pod spec once added. This is an alpha feature enabled by the
 * EphemeralContainers feature flag.
 */
class EphemeralContainer implements JsonSerializable
{
    /**
     * Arguments to the entrypoint. The docker image's CMD is used if this is not
     * provided. Variable references $(VAR_NAME) are expanded using the container's
     * environment. If a variable cannot be resolved, the reference in the input string
     * will be unchanged. The $(VAR_NAME) syntax can be escaped with a double $$, ie:
     * $$(VAR_NAME). Escaped references will never be expanded, regardless of whether
     * the variable exists or not. Cannot be updated. More info:
     * https://kubernetes.io/docs/tasks/inject-data-application/define-command-argument-container/#running-a-command-in-a-shell
     */
    private StringList $args;

    /**
     * Entrypoint array. Not executed within a shell. The docker image's ENTRYPOINT is
     * used if this is not provided. Variable references $(VAR_NAME) are expanded using
     * the container's environment. If a variable cannot be resolved, the reference in
     * the input string will be unchanged. The $(VAR_NAME) syntax can be escaped with a
     * double $$, ie: $$(VAR_NAME). Escaped references will never be expanded,
     * regardless of whether the variable exists or not. Cannot be updated. More info:
     * https://kubernetes.io/docs/tasks/inject-data-application/define-command-argument-container/#running-a-command-in-a-shell
     */
    private StringList $command;

    /**
     * List of environment variables to set in the container. Cannot be updated.
     */
    private EnvVarList $env;

    /**
     * List of sources to populate environment variables in the container. The keys
     * defined within a source must be a C_IDENTIFIER. All invalid keys will be
     * reported as an event when the container is starting. When a key exists in
     * multiple sources, the value associated with the last source will take
     * precedence. Values defined by an Env with a duplicate key will take precedence.
     * Cannot be updated.
     */
    private EnvFromSourceList $envFrom;

    /**
     * Docker image name. More info:
     * https://kubernetes.io/docs/concepts/containers/images
     */
    private string|null $image = null;

    /**
     * Image pull policy. One of Always, Never, IfNotPresent. Defaults to Always if
     * :latest tag is specified, or IfNotPresent otherwise. Cannot be updated. More
     * info: https://kubernetes.io/docs/concepts/containers/images#updating-images
     */
    private string|null $imagePullPolicy = null;

    /**
     * Lifecycle is not allowed for ephemeral containers.
     */
    private Lifecycle $lifecycle;

    /**
     * Probes are not allowed for ephemeral containers.
     */
    private Probe $livenessProbe;

    /**
     * Name of the ephemeral container specified as a DNS_LABEL. This name must be
     * unique among all containers, init containers and ephemeral containers.
     */
    private string $name;

    /**
     * Ports are not allowed for ephemeral containers.
     */
    private ContainerPortList $ports;

    /**
     * Probes are not allowed for ephemeral containers.
     */
    private Probe $readinessProbe;

    /**
     * Resources are not allowed for ephemeral containers. Ephemeral containers use
     * spare resources already allocated to the pod.
     */
    private ResourceRequirements $resources;

    /**
     * SecurityContext is not allowed for ephemeral containers.
     */
    private SecurityContext $securityContext;

    /**
     * Probes are not allowed for ephemeral containers.
     */
    private Probe $startupProbe;

    /**
     * Whether this container should allocate a buffer for stdin in the container
     * runtime. If this is not set, reads from stdin in the container will always
     * result in EOF. Default is false.
     */
    private bool|null $stdin = null;

    /**
     * Whether the container runtime should close the stdin channel after it has been
     * opened by a single attach. When stdin is true the stdin stream will remain open
     * across multiple attach sessions. If stdinOnce is set to true, stdin is opened on
     * container start, is empty until the first client attaches to stdin, and then
     * remains open and accepts data until the client disconnects, at which time stdin
     * is closed and remains closed until the container is restarted. If this flag is
     * false, a container processes that reads from stdin will never receive an EOF.
     * Default is false
     */
    private bool|null $stdinOnce = null;

    /**
     * If set, the name of the container from PodSpec that this ephemeral container
     * targets. The ephemeral container will be run in the namespaces (IPC, PID, etc)
     * of this container. If not set then the ephemeral container is run in whatever
     * namespaces are shared for the pod. Note that the container runtime must support
     * this feature.
     */
    private string|null $targetContainerName = null;

    /**
     * Optional: Path at which the file to which the container's termination message
     * will be written is mounted into the container's filesystem. Message written is
     * intended to be brief final status, such as an assertion failure message. Will be
     * truncated by the node if greater than 4096 bytes. The total message length
     * across all containers will be limited to 12kb. Defaults to /dev/termination-log.
     * Cannot be updated.
     */
    private string|null $terminationMessagePath = null;

    /**
     * Indicate how the termination message should be populated. File will use the
     * contents of terminationMessagePath to populate the container status message on
     * both success and failure. FallbackToLogsOnError will use the last chunk of
     * container log output if the termination message file is empty and the container
     * exited with an error. The log output is limited to 2048 bytes or 80 lines,
     * whichever is smaller. Defaults to File. Cannot be updated.
     */
    private string|null $terminationMessagePolicy = null;

    /**
     * Whether this container should allocate a TTY for itself, also requires 'stdin'
     * to be true. Default is false.
     */
    private bool|null $tty = null;

    /**
     * volumeDevices is the list of block devices to be used by the container. This is
     * a beta feature.
     */
    private VolumeDeviceList $volumeDevices;

    /**
     * Pod volumes to mount into the container's filesystem. Cannot be updated.
     */
    private VolumeMountList $volumeMounts;

    /**
     * Container's working directory. If not specified, the container runtime's default
     * will be used, which might be configured in the container image. Cannot be
     * updated.
     */
    private string|null $workingDir = null;

    public function __construct(string $name)
    {
        $this->args = new StringList();
        $this->command = new StringList();
        $this->env = new EnvVarList();
        $this->envFrom = new EnvFromSourceList();
        $this->lifecycle = new Lifecycle();
        $this->livenessProbe = new Probe();
        $this->name = $name;
        $this->ports = new ContainerPortList();
        $this->readinessProbe = new Probe();
        $this->resources = new ResourceRequirements();
        $this->securityContext = new SecurityContext();
        $this->startupProbe = new Probe();
        $this->volumeDevices = new VolumeDeviceList();
        $this->volumeMounts = new VolumeMountList();
    }

    public function args(): StringList
    {
        return $this->args;
    }

    public function command(): StringList
    {
        return $this->command;
    }

    public function env(): EnvVarList
    {
        return $this->env;
    }

    public function envFrom(): EnvFromSourceList
    {
        return $this->envFrom;
    }

    public function getImage(): string|null
    {
        return $this->image;
    }

    public function getImagePullPolicy(): string|null
    {
        return $this->imagePullPolicy;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStdin(): bool|null
    {
        return $this->stdin;
    }

    public function getStdinOnce(): bool|null
    {
        return $this->stdinOnce;
    }

    public function getTargetContainerName(): string|null
    {
        return $this->targetContainerName;
    }

    public function getTerminationMessagePath(): string|null
    {
        return $this->terminationMessagePath;
    }

    public function getTerminationMessagePolicy(): string|null
    {
        return $this->terminationMessagePolicy;
    }

    public function getTty(): bool|null
    {
        return $this->tty;
    }

    public function getWorkingDir(): string|null
    {
        return $this->workingDir;
    }

    public function lifecycle(): Lifecycle
    {
        return $this->lifecycle;
    }

    public function livenessProbe(): Probe
    {
        return $this->livenessProbe;
    }

    public function ports(): ContainerPortList
    {
        return $this->ports;
    }

    public function readinessProbe(): Probe
    {
        return $this->readinessProbe;
    }

    public function resources(): ResourceRequirements
    {
        return $this->resources;
    }

    public function securityContext(): SecurityContext
    {
        return $this->securityContext;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setImagePullPolicy(string $imagePullPolicy): self
    {
        $this->imagePullPolicy = $imagePullPolicy;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setStdin(bool $stdin): self
    {
        $this->stdin = $stdin;

        return $this;
    }

    public function setStdinOnce(bool $stdinOnce): self
    {
        $this->stdinOnce = $stdinOnce;

        return $this;
    }

    public function setTargetContainerName(string $targetContainerName): self
    {
        $this->targetContainerName = $targetContainerName;

        return $this;
    }

    public function setTerminationMessagePath(string $terminationMessagePath): self
    {
        $this->terminationMessagePath = $terminationMessagePath;

        return $this;
    }

    public function setTerminationMessagePolicy(string $terminationMessagePolicy): self
    {
        $this->terminationMessagePolicy = $terminationMessagePolicy;

        return $this;
    }

    public function setTty(bool $tty): self
    {
        $this->tty = $tty;

        return $this;
    }

    public function setWorkingDir(string $workingDir): self
    {
        $this->workingDir = $workingDir;

        return $this;
    }

    public function startupProbe(): Probe
    {
        return $this->startupProbe;
    }

    public function volumeDevices(): VolumeDeviceList
    {
        return $this->volumeDevices;
    }

    public function volumeMounts(): VolumeMountList
    {
        return $this->volumeMounts;
    }

    public function jsonSerialize(): array
    {
        return [
            'args' => $this->args,
            'command' => $this->command,
            'env' => $this->env,
            'envFrom' => $this->envFrom,
            'image' => $this->image,
            'imagePullPolicy' => $this->imagePullPolicy,
            'lifecycle' => $this->lifecycle,
            'livenessProbe' => $this->livenessProbe,
            'name' => $this->name,
            'ports' => $this->ports,
            'readinessProbe' => $this->readinessProbe,
            'resources' => $this->resources,
            'securityContext' => $this->securityContext,
            'startupProbe' => $this->startupProbe,
            'stdin' => $this->stdin,
            'stdinOnce' => $this->stdinOnce,
            'targetContainerName' => $this->targetContainerName,
            'terminationMessagePath' => $this->terminationMessagePath,
            'terminationMessagePolicy' => $this->terminationMessagePolicy,
            'tty' => $this->tty,
            'volumeDevices' => $this->volumeDevices,
            'volumeMounts' => $this->volumeMounts,
            'workingDir' => $this->workingDir,
        ];
    }
}
