<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\EnvFromSourceList;
use Dealroadshow\K8S\Data\Collection\EnvVarList;
use Dealroadshow\K8S\Data\Collection\VolumeList;
use Dealroadshow\K8S\Data\Collection\VolumeMountList;
use JsonSerializable;

/**
 * PodPresetSpec is a description of a pod preset.
 */
class PodPresetSpec implements JsonSerializable
{
    /**
     * Env defines the collection of EnvVar to inject into containers.
     */
    private EnvVarList $env;

    /**
     * EnvFrom defines the collection of EnvFromSource to inject into containers.
     */
    private EnvFromSourceList $envFrom;

    /**
     * Selector is a label query over a set of resources, in this case pods. Required.
     */
    private LabelSelector $selector;

    /**
     * VolumeMounts defines the collection of VolumeMount to inject into containers.
     */
    private VolumeMountList $volumeMounts;

    /**
     * Volumes defines the collection of Volume to inject into the pod.
     */
    private VolumeList $volumes;

    public function __construct()
    {
        $this->env = new EnvVarList();
        $this->envFrom = new EnvFromSourceList();
        $this->selector = new LabelSelector();
        $this->volumeMounts = new VolumeMountList();
        $this->volumes = new VolumeList();
    }

    public function env(): EnvVarList
    {
        return $this->env;
    }

    public function envFrom(): EnvFromSourceList
    {
        return $this->envFrom;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function volumeMounts(): VolumeMountList
    {
        return $this->volumeMounts;
    }

    public function volumes(): VolumeList
    {
        return $this->volumes;
    }

    public function jsonSerialize()
    {
        return [
            'env' => $this->env,
            'envFrom' => $this->envFrom,
            'selector' => $this->selector,
            'volumeMounts' => $this->volumeMounts,
            'volumes' => $this->volumes,
        ];
    }
}
