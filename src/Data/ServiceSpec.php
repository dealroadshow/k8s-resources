<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\ServicePortList;
use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * ServiceSpec describes the attributes that a user creates on a service.
 */
class ServiceSpec implements JsonSerializable
{
    /**
     * allocateLoadBalancerNodePorts defines if NodePorts will be automatically
     * allocated for services with type LoadBalancer.  Default is "true". It may be set
     * to "false" if the cluster load-balancer does not rely on NodePorts.
     * allocateLoadBalancerNodePorts may only be set for services with type
     * LoadBalancer and will be cleared if the type is changed to any other type. This
     * field is alpha-level and is only honored by servers that enable the
     * ServiceLBNodePortControl feature.
     */
    private bool|null $allocateLoadBalancerNodePorts = null;

    /**
     * clusterIP is the IP address of the service and is usually assigned randomly. If
     * an address is specified manually, is in-range (as per system configuration), and
     * is not in use, it will be allocated to the service; otherwise creation of the
     * service will fail. This field may not be changed through updates unless the type
     * field is also being changed to ExternalName (which requires this field to be
     * blank) or the type field is being changed from ExternalName (in which case this
     * field may optionally be specified, as describe above).  Valid values are "None",
     * empty string (""), or a valid IP address. Setting this to "None" makes a
     * "headless service" (no virtual IP), which is useful when direct endpoint
     * connections are preferred and proxying is not required.  Only applies to types
     * ClusterIP, NodePort, and LoadBalancer. If this field is specified when creating
     * a Service of type ExternalName, creation will fail. This field will be wiped
     * when updating a Service to type ExternalName. More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#virtual-ips-and-service-proxies
     */
    private string|null $clusterIP = null;

    /**
     * ClusterIPs is a list of IP addresses assigned to this service, and are usually
     * assigned randomly.  If an address is specified manually, is in-range (as per
     * system configuration), and is not in use, it will be allocated to the service;
     * otherwise creation of the service will fail. This field may not be changed
     * through updates unless the type field is also being changed to ExternalName
     * (which requires this field to be empty) or the type field is being changed from
     * ExternalName (in which case this field may optionally be specified, as describe
     * above).  Valid values are "None", empty string (""), or a valid IP address.
     * Setting this to "None" makes a "headless service" (no virtual IP), which is
     * useful when direct endpoint connections are preferred and proxying is not
     * required.  Only applies to types ClusterIP, NodePort, and LoadBalancer. If this
     * field is specified when creating a Service of type ExternalName, creation will
     * fail. This field will be wiped when updating a Service to type ExternalName.  If
     * this field is not specified, it will be initialized from the clusterIP field.
     * If this field is specified, clients must ensure that clusterIPs[0] and clusterIP
     * have the same value.
     *
     * Unless the "IPv6DualStack" feature gate is enabled, this field is limited to one
     * value, which must be the same as the clusterIP field.  If the feature gate is
     * enabled, this field may hold a maximum of two entries (dual-stack IPs, in either
     * order).  These IPs must correspond to the values of the ipFamilies field. Both
     * clusterIPs and ipFamilies are governed by the ipFamilyPolicy field. More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#virtual-ips-and-service-proxies
     */
    private StringList $clusterIPs;

    /**
     * externalIPs is a list of IP addresses for which nodes in the cluster will also
     * accept traffic for this service.  These IPs are not managed by Kubernetes.  The
     * user is responsible for ensuring that traffic arrives at a node with this IP.  A
     * common example is external load-balancers that are not part of the Kubernetes
     * system.
     */
    private StringList $externalIPs;

    /**
     * externalName is the external reference that discovery mechanisms will return as
     * an alias for this service (e.g. a DNS CNAME record). No proxying will be
     * involved.  Must be a lowercase RFC-1123 hostname
     * (https://tools.ietf.org/html/rfc1123) and requires `type` to be "ExternalName".
     */
    private string|null $externalName = null;

    /**
     * externalTrafficPolicy denotes if this Service desires to route external traffic
     * to node-local or cluster-wide endpoints. "Local" preserves the client source IP
     * and avoids a second hop for LoadBalancer and Nodeport type services, but risks
     * potentially imbalanced traffic spreading. "Cluster" obscures the client source
     * IP and may cause a second hop to another node, but should have good overall
     * load-spreading.
     */
    private string|null $externalTrafficPolicy = null;

    /**
     * healthCheckNodePort specifies the healthcheck nodePort for the service. This
     * only applies when type is set to LoadBalancer and externalTrafficPolicy is set
     * to Local. If a value is specified, is in-range, and is not in use, it will be
     * used.  If not specified, a value will be automatically allocated.  External
     * systems (e.g. load-balancers) can use this port to determine if a given node
     * holds endpoints for this service or not.  If this field is specified when
     * creating a Service which does not need it, creation will fail. This field will
     * be wiped when updating a Service to no longer need it (e.g. changing type).
     */
    private int|null $healthCheckNodePort = null;

    /**
     * InternalTrafficPolicy specifies if the cluster internal traffic should be routed
     * to all endpoints or node-local endpoints only. "Cluster" routes internal traffic
     * to a Service to all endpoints. "Local" routes traffic to node-local endpoints
     * only, traffic is dropped if no node-local endpoints are ready. The default value
     * is "Cluster".
     */
    private string|null $internalTrafficPolicy = null;

    /**
     * IPFamilies is a list of IP families (e.g. IPv4, IPv6) assigned to this service,
     * and is gated by the "IPv6DualStack" feature gate.  This field is usually
     * assigned automatically based on cluster configuration and the ipFamilyPolicy
     * field. If this field is specified manually, the requested family is available in
     * the cluster, and ipFamilyPolicy allows it, it will be used; otherwise creation
     * of the service will fail.  This field is conditionally mutable: it allows for
     * adding or removing a secondary IP family, but it does not allow changing the
     * primary IP family of the Service.  Valid values are "IPv4" and "IPv6".  This
     * field only applies to Services of types ClusterIP, NodePort, and LoadBalancer,
     * and does apply to "headless" services.  This field will be wiped when updating a
     * Service to type ExternalName.
     *
     * This field may hold a maximum of two entries (dual-stack families, in either
     * order).  These families must correspond to the values of the clusterIPs field,
     * if specified. Both clusterIPs and ipFamilies are governed by the ipFamilyPolicy
     * field.
     */
    private StringList $ipFamilies;

    /**
     * IPFamilyPolicy represents the dual-stack-ness requested or required by this
     * Service, and is gated by the "IPv6DualStack" feature gate.  If there is no value
     * provided, then this field will be set to SingleStack. Services can be
     * "SingleStack" (a single IP family), "PreferDualStack" (two IP families on
     * dual-stack configured clusters or a single IP family on single-stack clusters),
     * or "RequireDualStack" (two IP families on dual-stack configured clusters,
     * otherwise fail). The ipFamilies and clusterIPs fields depend on the value of
     * this field.  This field will be wiped when updating a service to type
     * ExternalName.
     */
    private string|null $ipFamilyPolicy = null;

    /**
     * loadBalancerClass is the class of the load balancer implementation this Service
     * belongs to. If specified, the value of this field must be a label-style
     * identifier, with an optional prefix, e.g. "internal-vip" or
     * "example.com/internal-vip". Unprefixed names are reserved for end-users. This
     * field can only be set when the Service type is 'LoadBalancer'. If not set, the
     * default load balancer implementation is used, today this is typically done
     * through the cloud provider integration, but should apply for any default
     * implementation. If set, it is assumed that a load balancer implementation is
     * watching for Services with a matching class. Any default load balancer
     * implementation (e.g. cloud providers) should ignore Services that set this
     * field. This field can only be set when creating or updating a Service to type
     * 'LoadBalancer'. Once set, it can not be changed. This field will be wiped when a
     * service is updated to a non 'LoadBalancer' type.
     */
    private string|null $loadBalancerClass = null;

    /**
     * Only applies to Service Type: LoadBalancer LoadBalancer will get created with
     * the IP specified in this field. This feature depends on whether the underlying
     * cloud-provider supports specifying the loadBalancerIP when a load balancer is
     * created. This field will be ignored if the cloud-provider does not support the
     * feature.
     */
    private string|null $loadBalancerIP = null;

    /**
     * If specified and supported by the platform, this will restrict traffic through
     * the cloud-provider load-balancer will be restricted to the specified client IPs.
     * This field will be ignored if the cloud-provider does not support the feature."
     * More info:
     * https://kubernetes.io/docs/tasks/access-application-cluster/configure-cloud-provider-firewall/
     */
    private StringList $loadBalancerSourceRanges;

    /**
     * The list of ports that are exposed by this service. More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#virtual-ips-and-service-proxies
     */
    private ServicePortList $ports;

    /**
     * publishNotReadyAddresses indicates that any agent which deals with endpoints for
     * this Service should disregard any indications of ready/not-ready. The primary
     * use case for setting this field is for a StatefulSet's Headless Service to
     * propagate SRV DNS records for its Pods for the purpose of peer discovery. The
     * Kubernetes controllers that generate Endpoints and EndpointSlice resources for
     * Services interpret this to mean that all endpoints are considered "ready" even
     * if the Pods themselves are not. Agents which consume only Kubernetes generated
     * endpoints through the Endpoints or EndpointSlice resources can safely assume
     * this behavior.
     */
    private bool|null $publishNotReadyAddresses = null;

    /**
     * Route service traffic to pods with label keys and values matching this selector.
     * If empty or not present, the service is assumed to have an external process
     * managing its endpoints, which Kubernetes will not modify. Only applies to types
     * ClusterIP, NodePort, and LoadBalancer. Ignored if type is ExternalName. More
     * info: https://kubernetes.io/docs/concepts/services-networking/service/
     */
    private StringMap $selector;

    /**
     * Supports "ClientIP" and "None". Used to maintain session affinity. Enable client
     * IP based session affinity. Must be ClientIP or None. Defaults to None. More
     * info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#virtual-ips-and-service-proxies
     */
    private string|null $sessionAffinity = null;

    /**
     * sessionAffinityConfig contains the configurations of session affinity.
     */
    private SessionAffinityConfig $sessionAffinityConfig;

    /**
     * topologyKeys is a preference-order list of topology keys which implementations
     * of services should use to preferentially sort endpoints when accessing this
     * Service, it can not be used at the same time as externalTrafficPolicy=Local.
     * Topology keys must be valid label keys and at most 16 keys may be specified.
     * Endpoints are chosen based on the first topology key with available backends. If
     * this field is specified and all entries have no backends that match the topology
     * of the client, the service has no backends for that client and connections
     * should fail. The special value "*" may be used to mean "any topology". This
     * catch-all value, if used, only makes sense as the last value in the list. If
     * this is not specified or empty, no topology constraints will be applied. This
     * field is alpha-level and is only honored by servers that enable the
     * ServiceTopology feature. This field is deprecated and will be removed in a
     * future version.
     */
    private StringList $topologyKeys;

    /**
     * type determines how the Service is exposed. Defaults to ClusterIP. Valid options
     * are ExternalName, ClusterIP, NodePort, and LoadBalancer. "ClusterIP" allocates a
     * cluster-internal IP address for load-balancing to endpoints. Endpoints are
     * determined by the selector or if that is not specified, by manual construction
     * of an Endpoints object or EndpointSlice objects. If clusterIP is "None", no
     * virtual IP is allocated and the endpoints are published as a set of endpoints
     * rather than a virtual IP. "NodePort" builds on ClusterIP and allocates a port on
     * every node which routes to the same endpoints as the clusterIP. "LoadBalancer"
     * builds on NodePort and creates an external load-balancer (if supported in the
     * current cloud) which routes to the same endpoints as the clusterIP.
     * "ExternalName" aliases this service to the specified externalName. Several other
     * fields do not apply to ExternalName services. More info:
     * https://kubernetes.io/docs/concepts/services-networking/service/#publishing-services-service-types
     */
    private string|null $type = null;

    public function __construct()
    {
        $this->clusterIPs = new StringList();
        $this->externalIPs = new StringList();
        $this->ipFamilies = new StringList();
        $this->loadBalancerSourceRanges = new StringList();
        $this->ports = new ServicePortList();
        $this->selector = new StringMap();
        $this->sessionAffinityConfig = new SessionAffinityConfig();
        $this->topologyKeys = new StringList();
    }

    public function clusterIPs(): StringList
    {
        return $this->clusterIPs;
    }

    public function externalIPs(): StringList
    {
        return $this->externalIPs;
    }

    public function getAllocateLoadBalancerNodePorts(): bool|null
    {
        return $this->allocateLoadBalancerNodePorts;
    }

    public function getClusterIP(): string|null
    {
        return $this->clusterIP;
    }

    public function getExternalName(): string|null
    {
        return $this->externalName;
    }

    public function getExternalTrafficPolicy(): string|null
    {
        return $this->externalTrafficPolicy;
    }

    public function getHealthCheckNodePort(): int|null
    {
        return $this->healthCheckNodePort;
    }

    public function getInternalTrafficPolicy(): string|null
    {
        return $this->internalTrafficPolicy;
    }

    public function getIpFamilyPolicy(): string|null
    {
        return $this->ipFamilyPolicy;
    }

    public function getLoadBalancerClass(): string|null
    {
        return $this->loadBalancerClass;
    }

    public function getLoadBalancerIP(): string|null
    {
        return $this->loadBalancerIP;
    }

    public function getPublishNotReadyAddresses(): bool|null
    {
        return $this->publishNotReadyAddresses;
    }

    public function getSessionAffinity(): string|null
    {
        return $this->sessionAffinity;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function ipFamilies(): StringList
    {
        return $this->ipFamilies;
    }

    public function loadBalancerSourceRanges(): StringList
    {
        return $this->loadBalancerSourceRanges;
    }

    public function ports(): ServicePortList
    {
        return $this->ports;
    }

    public function selector(): StringMap
    {
        return $this->selector;
    }

    public function sessionAffinityConfig(): SessionAffinityConfig
    {
        return $this->sessionAffinityConfig;
    }

    public function setAllocateLoadBalancerNodePorts(bool $allocateLoadBalancerNodePorts): self
    {
        $this->allocateLoadBalancerNodePorts = $allocateLoadBalancerNodePorts;

        return $this;
    }

    public function setClusterIP(string $clusterIP): self
    {
        $this->clusterIP = $clusterIP;

        return $this;
    }

    public function setExternalName(string $externalName): self
    {
        $this->externalName = $externalName;

        return $this;
    }

    public function setExternalTrafficPolicy(string $externalTrafficPolicy): self
    {
        $this->externalTrafficPolicy = $externalTrafficPolicy;

        return $this;
    }

    public function setHealthCheckNodePort(int $healthCheckNodePort): self
    {
        $this->healthCheckNodePort = $healthCheckNodePort;

        return $this;
    }

    public function setInternalTrafficPolicy(string $internalTrafficPolicy): self
    {
        $this->internalTrafficPolicy = $internalTrafficPolicy;

        return $this;
    }

    public function setIpFamilyPolicy(string $ipFamilyPolicy): self
    {
        $this->ipFamilyPolicy = $ipFamilyPolicy;

        return $this;
    }

    public function setLoadBalancerClass(string $loadBalancerClass): self
    {
        $this->loadBalancerClass = $loadBalancerClass;

        return $this;
    }

    public function setLoadBalancerIP(string $loadBalancerIP): self
    {
        $this->loadBalancerIP = $loadBalancerIP;

        return $this;
    }

    public function setPublishNotReadyAddresses(bool $publishNotReadyAddresses): self
    {
        $this->publishNotReadyAddresses = $publishNotReadyAddresses;

        return $this;
    }

    public function setSessionAffinity(string $sessionAffinity): self
    {
        $this->sessionAffinity = $sessionAffinity;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function topologyKeys(): StringList
    {
        return $this->topologyKeys;
    }

    public function jsonSerialize(): array
    {
        return [
            'allocateLoadBalancerNodePorts' => $this->allocateLoadBalancerNodePorts,
            'clusterIP' => $this->clusterIP,
            'clusterIPs' => $this->clusterIPs,
            'externalIPs' => $this->externalIPs,
            'externalName' => $this->externalName,
            'externalTrafficPolicy' => $this->externalTrafficPolicy,
            'healthCheckNodePort' => $this->healthCheckNodePort,
            'internalTrafficPolicy' => $this->internalTrafficPolicy,
            'ipFamilies' => $this->ipFamilies,
            'ipFamilyPolicy' => $this->ipFamilyPolicy,
            'loadBalancerClass' => $this->loadBalancerClass,
            'loadBalancerIP' => $this->loadBalancerIP,
            'loadBalancerSourceRanges' => $this->loadBalancerSourceRanges,
            'ports' => $this->ports,
            'publishNotReadyAddresses' => $this->publishNotReadyAddresses,
            'selector' => $this->selector,
            'sessionAffinity' => $this->sessionAffinity,
            'sessionAffinityConfig' => $this->sessionAffinityConfig,
            'topologyKeys' => $this->topologyKeys,
            'type' => $this->type,
        ];
    }
}
