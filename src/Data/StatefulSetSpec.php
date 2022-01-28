<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\PersistentVolumeClaimList;
use JsonSerializable;

/**
 * A StatefulSetSpec is the specification of a StatefulSet.
 */
class StatefulSetSpec implements JsonSerializable
{
    /**
     * Minimum number of seconds for which a newly created pod should be ready without
     * any of its container crashing for it to be considered available. Defaults to 0
     * (pod will be considered available as soon as it is ready) This is an alpha field
     * and requires enabling StatefulSetMinReadySeconds feature gate.
     */
    private int|null $minReadySeconds = null;

    /**
     * persistentVolumeClaimRetentionPolicy describes the lifecycle of persistent
     * volume claims created from volumeClaimTemplates. By default, all persistent
     * volume claims are created as needed and retained until manually deleted. This
     * policy allows the lifecycle to be altered, for example by deleting persistent
     * volume claims when their stateful set is deleted, or when their pod is scaled
     * down. This requires the StatefulSetAutoDeletePVC feature gate to be enabled,
     * which is alpha.  +optional
     */
    private StatefulSetPersistentVolumeClaimRetentionPolicy $persistentVolumeClaimRetentionPolicy;

    /**
     * podManagementPolicy controls how pods are created during initial scale up, when
     * replacing pods on nodes, or when scaling down. The default policy is
     * `OrderedReady`, where pods are created in increasing order (pod-0, then pod-1,
     * etc) and the controller will wait until each pod is ready before continuing.
     * When scaling down, the pods are removed in the opposite order. The alternative
     * policy is `Parallel` which will create pods in parallel to match the desired
     * scale without waiting, and on scale down will delete all pods at once.
     *
     * Possible enum values:
     *  - `"OrderedReady"` will create pods in strictly increasing order on scale up
     * and strictly decreasing order on scale down, progressing only when the previous
     * pod is ready or terminated. At most one pod will be changed at any time.
     *  - `"Parallel"` will create and delete pods as soon as the stateful set replica
     * count is changed, and will not wait for pods to be ready or complete
     * termination.
     */
    private string|null $podManagementPolicy = null;

    /**
     * replicas is the desired number of replicas of the given Template. These are
     * replicas in the sense that they are instantiations of the same Template, but
     * individual replicas also have a consistent identity. If unspecified, defaults to
     * 1.
     */
    private int|null $replicas = null;

    /**
     * revisionHistoryLimit is the maximum number of revisions that will be maintained
     * in the StatefulSet's revision history. The revision history consists of all
     * revisions not represented by a currently applied StatefulSetSpec version. The
     * default value is 10.
     */
    private int|null $revisionHistoryLimit = null;

    /**
     * selector is a label query over pods that should match the replica count. It must
     * match the pod template's labels. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/#label-selectors
     */
    private LabelSelector $selector;

    /**
     * serviceName is the name of the service that governs this StatefulSet. This
     * service must exist before the StatefulSet, and is responsible for the network
     * identity of the set. Pods get DNS/hostnames that follow the pattern:
     * pod-specific-string.serviceName.default.svc.cluster.local where
     * "pod-specific-string" is managed by the StatefulSet controller.
     */
    private string $serviceName;

    /**
     * template is the object that describes the pod that will be created if
     * insufficient replicas are detected. Each pod stamped out by the StatefulSet will
     * fulfill this Template, but have a unique identity from the rest of the
     * StatefulSet.
     */
    private PodTemplateSpec $template;

    /**
     * updateStrategy indicates the StatefulSetUpdateStrategy that will be employed to
     * update Pods in the StatefulSet when a revision is made to Template.
     */
    private StatefulSetUpdateStrategy $updateStrategy;

    /**
     * volumeClaimTemplates is a list of claims that pods are allowed to reference. The
     * StatefulSet controller is responsible for mapping network identities to claims
     * in a way that maintains the identity of a pod. Every claim in this list must
     * have at least one matching (by name) volumeMount in one container in the
     * template. A claim in this list takes precedence over any volumes in the
     * template, with the same name.
     */
    private PersistentVolumeClaimList $volumeClaimTemplates;

    public function __construct(string $serviceName)
    {
        $this->persistentVolumeClaimRetentionPolicy = new StatefulSetPersistentVolumeClaimRetentionPolicy();
        $this->selector = new LabelSelector();
        $this->serviceName = $serviceName;
        $this->template = new PodTemplateSpec();
        $this->updateStrategy = new StatefulSetUpdateStrategy();
        $this->volumeClaimTemplates = new PersistentVolumeClaimList();
    }

    public function getMinReadySeconds(): int|null
    {
        return $this->minReadySeconds;
    }

    public function getPodManagementPolicy(): string|null
    {
        return $this->podManagementPolicy;
    }

    public function getReplicas(): int|null
    {
        return $this->replicas;
    }

    public function getRevisionHistoryLimit(): int|null
    {
        return $this->revisionHistoryLimit;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function persistentVolumeClaimRetentionPolicy(): StatefulSetPersistentVolumeClaimRetentionPolicy
    {
        return $this->persistentVolumeClaimRetentionPolicy;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setMinReadySeconds(int $minReadySeconds): self
    {
        $this->minReadySeconds = $minReadySeconds;

        return $this;
    }

    public function setPodManagementPolicy(string $podManagementPolicy): self
    {
        $this->podManagementPolicy = $podManagementPolicy;

        return $this;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function setRevisionHistoryLimit(int $revisionHistoryLimit): self
    {
        $this->revisionHistoryLimit = $revisionHistoryLimit;

        return $this;
    }

    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    public function template(): PodTemplateSpec
    {
        return $this->template;
    }

    public function updateStrategy(): StatefulSetUpdateStrategy
    {
        return $this->updateStrategy;
    }

    public function volumeClaimTemplates(): PersistentVolumeClaimList
    {
        return $this->volumeClaimTemplates;
    }

    public function jsonSerialize(): array
    {
        return [
            'minReadySeconds' => $this->minReadySeconds,
            'persistentVolumeClaimRetentionPolicy' => $this->persistentVolumeClaimRetentionPolicy,
            'podManagementPolicy' => $this->podManagementPolicy,
            'replicas' => $this->replicas,
            'revisionHistoryLimit' => $this->revisionHistoryLimit,
            'selector' => $this->selector,
            'serviceName' => $this->serviceName,
            'template' => $this->template,
            'updateStrategy' => $this->updateStrategy,
            'volumeClaimTemplates' => $this->volumeClaimTemplates,
        ];
    }
}
