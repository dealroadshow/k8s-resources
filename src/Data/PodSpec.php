<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ContainerList;
use Dealroadshow\K8S\Data\Collection\EphemeralContainerList;
use Dealroadshow\K8S\Data\Collection\HostAliasList;
use Dealroadshow\K8S\Data\Collection\LocalObjectReferenceList;
use Dealroadshow\K8S\Data\Collection\PodReadinessGateList;
use Dealroadshow\K8S\Data\Collection\StringMap;
use Dealroadshow\K8S\Data\Collection\StringOrFloatMap;
use Dealroadshow\K8S\Data\Collection\TolerationList;
use Dealroadshow\K8S\Data\Collection\TopologySpreadConstraintList;
use Dealroadshow\K8S\Data\Collection\VolumeList;
use JsonSerializable;

/**
 * PodSpec is a description of a pod.
 */
class PodSpec implements JsonSerializable
{
    /**
     * Optional duration in seconds the pod may be active on the node relative to
     * StartTime before the system will actively try to mark it failed and kill
     * associated containers. Value must be a positive integer.
     */
    private int|null $activeDeadlineSeconds = null;

    /**
     * If specified, the pod's scheduling constraints
     */
    private Affinity $affinity;

    /**
     * AutomountServiceAccountToken indicates whether a service account token should be
     * automatically mounted.
     */
    private bool|null $automountServiceAccountToken = null;

    /**
     * List of containers belonging to the pod. Containers cannot currently be added or
     * removed. There must be at least one container in a Pod. Cannot be updated.
     */
    private ContainerList $containers;

    /**
     * Specifies the DNS parameters of a pod. Parameters specified here will be merged
     * to the generated DNS configuration based on DNSPolicy.
     */
    private PodDNSConfig $dnsConfig;

    /**
     * Set DNS policy for the pod. Defaults to "ClusterFirst". Valid values are
     * 'ClusterFirstWithHostNet', 'ClusterFirst', 'Default' or 'None'. DNS parameters
     * given in DNSConfig will be merged with the policy selected with DNSPolicy. To
     * have DNS options set along with hostNetwork, you have to specify DNS policy
     * explicitly to 'ClusterFirstWithHostNet'.
     */
    private string|null $dnsPolicy = null;

    /**
     * EnableServiceLinks indicates whether information about services should be
     * injected into pod's environment variables, matching the syntax of Docker links.
     * Optional: Defaults to true.
     */
    private bool|null $enableServiceLinks = null;

    /**
     * List of ephemeral containers run in this pod. Ephemeral containers may be run in
     * an existing pod to perform user-initiated actions such as debugging. This list
     * cannot be specified when creating a pod, and it cannot be modified by updating
     * the pod spec. In order to add an ephemeral container to an existing pod, use the
     * pod's ephemeralcontainers subresource.
     */
    private EphemeralContainerList $ephemeralContainers;

    /**
     * HostAliases is an optional list of hosts and IPs that will be injected into the
     * pod's hosts file if specified. This is only valid for non-hostNetwork pods.
     */
    private HostAliasList $hostAliases;

    /**
     * Use the host's ipc namespace. Optional: Default to false.
     */
    private bool|null $hostIPC = null;

    /**
     * Host networking requested for this pod. Use the host's network namespace. If
     * this option is set, the ports that will be used must be specified. Default to
     * false.
     */
    private bool|null $hostNetwork = null;

    /**
     * Use the host's pid namespace. Optional: Default to false.
     */
    private bool|null $hostPID = null;

    /**
     * Use the host's user namespace. Optional: Default to true. If set to true or not
     * present, the pod will be run in the host user namespace, useful for when the pod
     * needs a feature only available to the host user namespace, such as loading a
     * kernel module with CAP_SYS_MODULE. When set to false, a new userns is created
     * for the pod. Setting false is useful for mitigating container breakout
     * vulnerabilities even allowing users to run their containers as root without
     * actually having root privileges on the host. This field is alpha-level and is
     * only honored by servers that enable the UserNamespacesSupport feature.
     */
    private bool|null $hostUsers = null;

    /**
     * Specifies the hostname of the Pod If not specified, the pod's hostname will be
     * set to a system-defined value.
     */
    private string|null $hostname = null;

    /**
     * ImagePullSecrets is an optional list of references to secrets in the same
     * namespace to use for pulling any of the images used by this PodSpec. If
     * specified, these secrets will be passed to individual puller implementations for
     * them to use. More info:
     * https://kubernetes.io/docs/concepts/containers/images#specifying-imagepullsecrets-on-a-pod
     */
    private LocalObjectReferenceList $imagePullSecrets;

    /**
     * List of initialization containers belonging to the pod. Init containers are
     * executed in order prior to containers being started. If any init container
     * fails, the pod is considered to have failed and is handled according to its
     * restartPolicy. The name for an init container or normal container must be unique
     * among all containers. Init containers may not have Lifecycle actions, Readiness
     * probes, Liveness probes, or Startup probes. The resourceRequirements of an init
     * container are taken into account during scheduling by finding the highest
     * request/limit for each resource type, and then using the max of of that value or
     * the sum of the normal containers. Limits are applied to init containers in a
     * similar fashion. Init containers cannot currently be added or removed. Cannot be
     * updated. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/init-containers/
     */
    private ContainerList $initContainers;

    /**
     * NodeName is a request to schedule this pod onto a specific node. If it is
     * non-empty, the scheduler simply schedules this pod onto that node, assuming that
     * it fits resource requirements.
     */
    private string|null $nodeName = null;

    /**
     * NodeSelector is a selector which must be true for the pod to fit on a node.
     * Selector which must match a node's labels for the pod to be scheduled on that
     * node. More info:
     * https://kubernetes.io/docs/concepts/configuration/assign-pod-node/
     */
    private StringMap $nodeSelector;

    /**
     * Specifies the OS of the containers in the pod. Some pod and container fields are
     * restricted if this is set.
     *
     * If the OS field is set to linux, the following fields must be unset:
     * -securityContext.windowsOptions
     *
     * If the OS field is set to windows, following fields must be unset: -
     * spec.hostPID - spec.hostIPC - spec.hostUsers -
     * spec.securityContext.seLinuxOptions - spec.securityContext.seccompProfile -
     * spec.securityContext.fsGroup - spec.securityContext.fsGroupChangePolicy -
     * spec.securityContext.sysctls - spec.shareProcessNamespace -
     * spec.securityContext.runAsUser - spec.securityContext.runAsGroup -
     * spec.securityContext.supplementalGroups -
     * spec.containers[*].securityContext.seLinuxOptions -
     * spec.containers[*].securityContext.seccompProfile -
     * spec.containers[*].securityContext.capabilities -
     * spec.containers[*].securityContext.readOnlyRootFilesystem -
     * spec.containers[*].securityContext.privileged -
     * spec.containers[*].securityContext.allowPrivilegeEscalation -
     * spec.containers[*].securityContext.procMount -
     * spec.containers[*].securityContext.runAsUser -
     * spec.containers[*].securityContext.runAsGroup
     */
    private PodOS|null $os = null;

    /**
     * Overhead represents the resource overhead associated with running a pod for a
     * given RuntimeClass. This field will be autopopulated at admission time by the
     * RuntimeClass admission controller. If the RuntimeClass admission controller is
     * enabled, overhead must not be set in Pod create requests. The RuntimeClass
     * admission controller will reject Pod create requests which have the overhead
     * already set. If RuntimeClass is configured and selected in the PodSpec, Overhead
     * will be set to the value defined in the corresponding RuntimeClass, otherwise it
     * will remain unset and treated as zero. More info:
     * https://git.k8s.io/enhancements/keps/sig-node/688-pod-overhead/README.md
     */
    private StringOrFloatMap $overhead;

    /**
     * PreemptionPolicy is the Policy for preempting pods with lower priority. One of
     * Never, PreemptLowerPriority. Defaults to PreemptLowerPriority if unset.
     */
    private string|null $preemptionPolicy = null;

    /**
     * The priority value. Various system components use this field to find the
     * priority of the pod. When Priority Admission Controller is enabled, it prevents
     * users from setting this field. The admission controller populates this field
     * from PriorityClassName. The higher the value, the higher the priority.
     */
    private int|null $priority = null;

    /**
     * If specified, indicates the pod's priority. "system-node-critical" and
     * "system-cluster-critical" are two special keywords which indicate the highest
     * priorities with the former being the highest priority. Any other name must be
     * defined by creating a PriorityClass object with that name. If not specified, the
     * pod priority will be default or zero if there is no default.
     */
    private string|null $priorityClassName = null;

    /**
     * If specified, all readiness gates will be evaluated for pod readiness. A pod is
     * ready when all its containers are ready AND all conditions specified in the
     * readiness gates have status equal to "True" More info:
     * https://git.k8s.io/enhancements/keps/sig-network/580-pod-readiness-gates
     */
    private PodReadinessGateList $readinessGates;

    /**
     * Restart policy for all containers within the pod. One of Always, OnFailure,
     * Never. Default to Always. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle/#restart-policy
     */
    private string|null $restartPolicy = null;

    /**
     * RuntimeClassName refers to a RuntimeClass object in the node.k8s.io group, which
     * should be used to run this pod.  If no RuntimeClass resource matches the named
     * class, the pod will not be run. If unset or empty, the "legacy" RuntimeClass
     * will be used, which is an implicit class with an empty definition that uses the
     * default runtime handler. More info:
     * https://git.k8s.io/enhancements/keps/sig-node/585-runtime-class
     */
    private string|null $runtimeClassName = null;

    /**
     * If specified, the pod will be dispatched by specified scheduler. If not
     * specified, the pod will be dispatched by default scheduler.
     */
    private string|null $schedulerName = null;

    /**
     * SecurityContext holds pod-level security attributes and common container
     * settings. Optional: Defaults to empty.  See type description for default values
     * of each field.
     */
    private PodSecurityContext $securityContext;

    /**
     * DeprecatedServiceAccount is a depreciated alias for ServiceAccountName.
     * Deprecated: Use serviceAccountName instead.
     */
    private string|null $serviceAccount = null;

    /**
     * ServiceAccountName is the name of the ServiceAccount to use to run this pod.
     * More info:
     * https://kubernetes.io/docs/tasks/configure-pod-container/configure-service-account/
     */
    private string|null $serviceAccountName = null;

    /**
     * If true the pod's hostname will be configured as the pod's FQDN, rather than the
     * leaf name (the default). In Linux containers, this means setting the FQDN in the
     * hostname field of the kernel (the nodename field of struct utsname). In Windows
     * containers, this means setting the registry value of hostname for the registry
     * key HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\Tcpip\Parameters to
     * FQDN. If a pod does not have FQDN, this has no effect. Default to false.
     */
    private bool|null $setHostnameAsFQDN = null;

    /**
     * Share a single process namespace between all of the containers in a pod. When
     * this is set containers will be able to view and signal processes from other
     * containers in the same pod, and the first process in each container will not be
     * assigned PID 1. HostPID and ShareProcessNamespace cannot both be set. Optional:
     * Default to false.
     */
    private bool|null $shareProcessNamespace = null;

    /**
     * If specified, the fully qualified Pod hostname will be
     * "<hostname>.<subdomain>.<pod namespace>.svc.<cluster domain>". If not specified,
     * the pod will not have a domainname at all.
     */
    private string|null $subdomain = null;

    /**
     * Optional duration in seconds the pod needs to terminate gracefully. May be
     * decreased in delete request. Value must be non-negative integer. The value zero
     * indicates stop immediately via the kill signal (no opportunity to shut down). If
     * this value is nil, the default grace period will be used instead. The grace
     * period is the duration in seconds after the processes running in the pod are
     * sent a termination signal and the time when the processes are forcibly halted
     * with a kill signal. Set this value longer than the expected cleanup time for
     * your process. Defaults to 30 seconds.
     */
    private int|null $terminationGracePeriodSeconds = null;

    /**
     * If specified, the pod's tolerations.
     */
    private TolerationList $tolerations;

    /**
     * TopologySpreadConstraints describes how a group of pods ought to spread across
     * topology domains. Scheduler will schedule pods in a way which abides by the
     * constraints. All topologySpreadConstraints are ANDed.
     */
    private TopologySpreadConstraintList $topologySpreadConstraints;

    /**
     * List of volumes that can be mounted by containers belonging to the pod. More
     * info: https://kubernetes.io/docs/concepts/storage/volumes
     */
    private VolumeList $volumes;

    public function __construct()
    {
        $this->affinity = new Affinity();
        $this->containers = new ContainerList();
        $this->dnsConfig = new PodDNSConfig();
        $this->ephemeralContainers = new EphemeralContainerList();
        $this->hostAliases = new HostAliasList();
        $this->imagePullSecrets = new LocalObjectReferenceList();
        $this->initContainers = new ContainerList();
        $this->nodeSelector = new StringMap();
        $this->overhead = new StringOrFloatMap();
        $this->readinessGates = new PodReadinessGateList();
        $this->securityContext = new PodSecurityContext();
        $this->tolerations = new TolerationList();
        $this->topologySpreadConstraints = new TopologySpreadConstraintList();
        $this->volumes = new VolumeList();
    }

    public function affinity(): Affinity
    {
        return $this->affinity;
    }

    public function containers(): ContainerList
    {
        return $this->containers;
    }

    public function dnsConfig(): PodDNSConfig
    {
        return $this->dnsConfig;
    }

    public function ephemeralContainers(): EphemeralContainerList
    {
        return $this->ephemeralContainers;
    }

    public function getActiveDeadlineSeconds(): int|null
    {
        return $this->activeDeadlineSeconds;
    }

    public function getAutomountServiceAccountToken(): bool|null
    {
        return $this->automountServiceAccountToken;
    }

    public function getDnsPolicy(): string|null
    {
        return $this->dnsPolicy;
    }

    public function getEnableServiceLinks(): bool|null
    {
        return $this->enableServiceLinks;
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

    public function getHostUsers(): bool|null
    {
        return $this->hostUsers;
    }

    public function getHostname(): string|null
    {
        return $this->hostname;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
    }

    public function getOs(): PodOS|null
    {
        return $this->os;
    }

    public function getPreemptionPolicy(): string|null
    {
        return $this->preemptionPolicy;
    }

    public function getPriority(): int|null
    {
        return $this->priority;
    }

    public function getPriorityClassName(): string|null
    {
        return $this->priorityClassName;
    }

    public function getRestartPolicy(): string|null
    {
        return $this->restartPolicy;
    }

    public function getRuntimeClassName(): string|null
    {
        return $this->runtimeClassName;
    }

    public function getSchedulerName(): string|null
    {
        return $this->schedulerName;
    }

    public function getServiceAccount(): string|null
    {
        return $this->serviceAccount;
    }

    public function getServiceAccountName(): string|null
    {
        return $this->serviceAccountName;
    }

    public function getSetHostnameAsFQDN(): bool|null
    {
        return $this->setHostnameAsFQDN;
    }

    public function getShareProcessNamespace(): bool|null
    {
        return $this->shareProcessNamespace;
    }

    public function getSubdomain(): string|null
    {
        return $this->subdomain;
    }

    public function getTerminationGracePeriodSeconds(): int|null
    {
        return $this->terminationGracePeriodSeconds;
    }

    public function hostAliases(): HostAliasList
    {
        return $this->hostAliases;
    }

    public function imagePullSecrets(): LocalObjectReferenceList
    {
        return $this->imagePullSecrets;
    }

    public function initContainers(): ContainerList
    {
        return $this->initContainers;
    }

    public function nodeSelector(): StringMap
    {
        return $this->nodeSelector;
    }

    public function overhead(): StringOrFloatMap
    {
        return $this->overhead;
    }

    public function readinessGates(): PodReadinessGateList
    {
        return $this->readinessGates;
    }

    public function securityContext(): PodSecurityContext
    {
        return $this->securityContext;
    }

    public function setActiveDeadlineSeconds(int $activeDeadlineSeconds): self
    {
        $this->activeDeadlineSeconds = $activeDeadlineSeconds;

        return $this;
    }

    public function setAutomountServiceAccountToken(bool $automountServiceAccountToken): self
    {
        $this->automountServiceAccountToken = $automountServiceAccountToken;

        return $this;
    }

    public function setDnsPolicy(string $dnsPolicy): self
    {
        $this->dnsPolicy = $dnsPolicy;

        return $this;
    }

    public function setEnableServiceLinks(bool $enableServiceLinks): self
    {
        $this->enableServiceLinks = $enableServiceLinks;

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

    public function setHostUsers(bool $hostUsers): self
    {
        $this->hostUsers = $hostUsers;

        return $this;
    }

    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function setOs(PodOS $os): self
    {
        $this->os = $os;

        return $this;
    }

    public function setPreemptionPolicy(string $preemptionPolicy): self
    {
        $this->preemptionPolicy = $preemptionPolicy;

        return $this;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function setPriorityClassName(string $priorityClassName): self
    {
        $this->priorityClassName = $priorityClassName;

        return $this;
    }

    public function setRestartPolicy(string $restartPolicy): self
    {
        $this->restartPolicy = $restartPolicy;

        return $this;
    }

    public function setRuntimeClassName(string $runtimeClassName): self
    {
        $this->runtimeClassName = $runtimeClassName;

        return $this;
    }

    public function setSchedulerName(string $schedulerName): self
    {
        $this->schedulerName = $schedulerName;

        return $this;
    }

    public function setServiceAccount(string $serviceAccount): self
    {
        $this->serviceAccount = $serviceAccount;

        return $this;
    }

    public function setServiceAccountName(string $serviceAccountName): self
    {
        $this->serviceAccountName = $serviceAccountName;

        return $this;
    }

    public function setSetHostnameAsFQDN(bool $setHostnameAsFQDN): self
    {
        $this->setHostnameAsFQDN = $setHostnameAsFQDN;

        return $this;
    }

    public function setShareProcessNamespace(bool $shareProcessNamespace): self
    {
        $this->shareProcessNamespace = $shareProcessNamespace;

        return $this;
    }

    public function setSubdomain(string $subdomain): self
    {
        $this->subdomain = $subdomain;

        return $this;
    }

    public function setTerminationGracePeriodSeconds(int $terminationGracePeriodSeconds): self
    {
        $this->terminationGracePeriodSeconds = $terminationGracePeriodSeconds;

        return $this;
    }

    public function tolerations(): TolerationList
    {
        return $this->tolerations;
    }

    public function topologySpreadConstraints(): TopologySpreadConstraintList
    {
        return $this->topologySpreadConstraints;
    }

    public function volumes(): VolumeList
    {
        return $this->volumes;
    }

    public function jsonSerialize(): array
    {
        return [
            'activeDeadlineSeconds' => $this->activeDeadlineSeconds,
            'affinity' => $this->affinity,
            'automountServiceAccountToken' => $this->automountServiceAccountToken,
            'containers' => $this->containers,
            'dnsConfig' => $this->dnsConfig,
            'dnsPolicy' => $this->dnsPolicy,
            'enableServiceLinks' => $this->enableServiceLinks,
            'ephemeralContainers' => $this->ephemeralContainers,
            'hostAliases' => $this->hostAliases,
            'hostIPC' => $this->hostIPC,
            'hostNetwork' => $this->hostNetwork,
            'hostPID' => $this->hostPID,
            'hostUsers' => $this->hostUsers,
            'hostname' => $this->hostname,
            'imagePullSecrets' => $this->imagePullSecrets,
            'initContainers' => $this->initContainers,
            'nodeName' => $this->nodeName,
            'nodeSelector' => $this->nodeSelector,
            'os' => $this->os,
            'overhead' => $this->overhead,
            'preemptionPolicy' => $this->preemptionPolicy,
            'priority' => $this->priority,
            'priorityClassName' => $this->priorityClassName,
            'readinessGates' => $this->readinessGates,
            'restartPolicy' => $this->restartPolicy,
            'runtimeClassName' => $this->runtimeClassName,
            'schedulerName' => $this->schedulerName,
            'securityContext' => $this->securityContext,
            'serviceAccount' => $this->serviceAccount,
            'serviceAccountName' => $this->serviceAccountName,
            'setHostnameAsFQDN' => $this->setHostnameAsFQDN,
            'shareProcessNamespace' => $this->shareProcessNamespace,
            'subdomain' => $this->subdomain,
            'terminationGracePeriodSeconds' => $this->terminationGracePeriodSeconds,
            'tolerations' => $this->tolerations,
            'topologySpreadConstraints' => $this->topologySpreadConstraints,
            'volumes' => $this->volumes,
        ];
    }
}
