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
 * A single application container that you want to run within a pod.
 */
class Container implements JsonSerializable
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
     * https://kubernetes.io/docs/concepts/containers/images This field is optional to
     * allow higher level config management to default or override container images in
     * workload controllers like Deployments and StatefulSets.
     */
    private string|null $image = null;

    /**
     * Image pull policy. One of Always, Never, IfNotPresent. Defaults to Always if
     * :latest tag is specified, or IfNotPresent otherwise. Cannot be updated. More
     * info: https://kubernetes.io/docs/concepts/containers/images#updating-images
     */
    private string|null $imagePullPolicy = null;

    /**
     * Actions that the management system should take in response to container
     * lifecycle events. Cannot be updated.
     */
    private Lifecycle $lifecycle;

    /**
     * Periodic probe of container liveness. Container will be restarted if the probe
     * fails. Cannot be updated. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
     */
    private Probe $livenessProbe;

    /**
     * Name of the container specified as a DNS_LABEL. Each container in a pod must
     * have a unique name (DNS_LABEL). Cannot be updated.
     */
    private string $name;

    /**
     * List of ports to expose from the container. Exposing a port here gives the
     * system additional information about the network connections a container uses,
     * but is primarily informational. Not specifying a port here DOES NOT prevent that
     * port from being exposed. Any port which is listening on the default "0.0.0.0"
     * address inside a container will be accessible from the network. Cannot be
     * updated.
     */
    private ContainerPortList $ports;

    /**
     * Periodic probe of container service readiness. Container will be removed from
     * service endpoints if the probe fails. Cannot be updated. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
     */
    private Probe $readinessProbe;

    /**
     * Compute Resources required by this container. Cannot be updated. More info:
     * https://kubernetes.io/docs/concepts/configuration/manage-compute-resources-container/
     */
    private ResourceRequirements $resources;

    /**
     * Security options the pod should run with. More info:
     * https://kubernetes.io/docs/concepts/policy/security-context/ More info:
     * https://kubernetes.io/docs/tasks/configure-pod-container/security-context/
     */
    private SecurityContext $securityContext;

    /**
     * StartupProbe indicates that the Pod has successfully initialized. If specified,
     * no other probes are executed until this completes successfully. If this probe
     * fails, the Pod will be restarted, just as if the livenessProbe failed. This can
     * be used to provide different probe parameters at the beginning of a Pod's
     * lifecycle, when it might take a long time to load data or warm a cache, than
     * during steady-state operation. This cannot be updated. This is an alpha feature
     * enabled by the StartupProbe feature flag. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
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
            'terminationMessagePath' => $this->terminationMessagePath,
            'terminationMessagePolicy' => $this->terminationMessagePolicy,
            'tty' => $this->tty,
            'volumeDevices' => $this->volumeDevices,
            'volumeMounts' => $this->volumeMounts,
            'workingDir' => $this->workingDir,
        ];
    }
}
