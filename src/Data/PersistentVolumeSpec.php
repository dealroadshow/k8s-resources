<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\QuantityMap;
use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * PersistentVolumeSpec is the specification of a persistent volume.
 */
class PersistentVolumeSpec implements JsonSerializable
{
    /**
     * AccessModes contains all ways the volume can be mounted. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#access-modes
     */
    private StringList $accessModes;

    /**
     * AWSElasticBlockStore represents an AWS Disk resource that is attached to a
     * kubelet's host machine and then exposed to the pod. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#awselasticblockstore
     *
     * @var AWSElasticBlockStoreVolumeSource|null
     */
    private ?AWSElasticBlockStoreVolumeSource $awsElasticBlockStore = null;

    /**
     * AzureDisk represents an Azure Data Disk mount on the host and bind mount to the
     * pod.
     *
     * @var AzureDiskVolumeSource|null
     */
    private ?AzureDiskVolumeSource $azureDisk = null;

    /**
     * AzureFile represents an Azure File Service mount on the host and bind mount to
     * the pod.
     *
     * @var AzureFilePersistentVolumeSource|null
     */
    private ?AzureFilePersistentVolumeSource $azureFile = null;

    /**
     * A description of the persistent volume's resources and capacity. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#capacity
     */
    private QuantityMap $capacity;

    /**
     * CephFS represents a Ceph FS mount on the host that shares a pod's lifetime
     */
    private CephFSPersistentVolumeSource $cephfs;

    /**
     * Cinder represents a cinder volume attached and mounted on kubelets host machine.
     * More info: https://examples.k8s.io/mysql-cinder-pd/README.md
     *
     * @var CinderPersistentVolumeSource|null
     */
    private ?CinderPersistentVolumeSource $cinder = null;

    /**
     * ClaimRef is part of a bi-directional binding between PersistentVolume and
     * PersistentVolumeClaim. Expected to be non-nil when bound. claim.VolumeName is
     * the authoritative bind between PV and PVC. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#binding
     */
    private ObjectReference $claimRef;

    /**
     * CSI represents storage that is handled by an external CSI driver (Beta feature).
     *
     * @var CSIPersistentVolumeSource|null
     */
    private ?CSIPersistentVolumeSource $csi = null;

    /**
     * FC represents a Fibre Channel resource that is attached to a kubelet's host
     * machine and then exposed to the pod.
     */
    private FCVolumeSource $fc;

    /**
     * FlexVolume represents a generic volume resource that is provisioned/attached
     * using an exec based plugin.
     *
     * @var FlexPersistentVolumeSource|null
     */
    private ?FlexPersistentVolumeSource $flexVolume = null;

    /**
     * Flocker represents a Flocker volume attached to a kubelet's host machine and
     * exposed to the pod for its usage. This depends on the Flocker control service
     * being running
     */
    private FlockerVolumeSource $flocker;

    /**
     * GCEPersistentDisk represents a GCE Disk resource that is attached to a kubelet's
     * host machine and then exposed to the pod. Provisioned by an admin. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     *
     * @var GCEPersistentDiskVolumeSource|null
     */
    private ?GCEPersistentDiskVolumeSource $gcePersistentDisk = null;

    /**
     * Glusterfs represents a Glusterfs volume that is attached to a host and exposed
     * to the pod. Provisioned by an admin. More info:
     * https://examples.k8s.io/volumes/glusterfs/README.md
     *
     * @var GlusterfsPersistentVolumeSource|null
     */
    private ?GlusterfsPersistentVolumeSource $glusterfs = null;

    /**
     * HostPath represents a directory on the host. Provisioned by a developer or
     * tester. This is useful for single-node development and testing only! On-host
     * storage is not supported in any way and WILL NOT WORK in a multi-node cluster.
     * More info: https://kubernetes.io/docs/concepts/storage/volumes#hostpath
     *
     * @var HostPathVolumeSource|null
     */
    private ?HostPathVolumeSource $hostPath = null;

    /**
     * ISCSI represents an ISCSI Disk resource that is attached to a kubelet's host
     * machine and then exposed to the pod. Provisioned by an admin.
     *
     * @var ISCSIPersistentVolumeSource|null
     */
    private ?ISCSIPersistentVolumeSource $iscsi = null;

    /**
     * Local represents directly-attached storage with node affinity
     *
     * @var LocalVolumeSource|null
     */
    private ?LocalVolumeSource $local = null;

    /**
     * A list of mount options, e.g. ["ro", "soft"]. Not validated - mount will simply
     * fail if one is invalid. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes/#mount-options
     */
    private StringList $mountOptions;

    /**
     * NFS represents an NFS mount on the host. Provisioned by an admin. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     *
     * @var NFSVolumeSource|null
     */
    private ?NFSVolumeSource $nfs = null;

    /**
     * NodeAffinity defines constraints that limit what nodes this volume can be
     * accessed from. This field influences the scheduling of pods that use this
     * volume.
     */
    private VolumeNodeAffinity $nodeAffinity;

    /**
     * What happens to a persistent volume when released from its claim. Valid options
     * are Retain (default for manually created PersistentVolumes), Delete (default for
     * dynamically provisioned PersistentVolumes), and Recycle (deprecated). Recycle
     * must be supported by the volume plugin underlying this PersistentVolume. More
     * info: https://kubernetes.io/docs/concepts/storage/persistent-volumes#reclaiming
     *
     * @var string|null
     */
    private ?string $persistentVolumeReclaimPolicy = null;

    /**
     * PhotonPersistentDisk represents a PhotonController persistent disk attached and
     * mounted on kubelets host machine
     *
     * @var PhotonPersistentDiskVolumeSource|null
     */
    private ?PhotonPersistentDiskVolumeSource $photonPersistentDisk = null;

    /**
     * PortworxVolume represents a portworx volume attached and mounted on kubelets
     * host machine
     *
     * @var PortworxVolumeSource|null
     */
    private ?PortworxVolumeSource $portworxVolume = null;

    /**
     * Quobyte represents a Quobyte mount on the host that shares a pod's lifetime
     *
     * @var QuobyteVolumeSource|null
     */
    private ?QuobyteVolumeSource $quobyte = null;

    /**
     * RBD represents a Rados Block Device mount on the host that shares a pod's
     * lifetime. More info: https://examples.k8s.io/volumes/rbd/README.md
     *
     * @var RBDPersistentVolumeSource|null
     */
    private ?RBDPersistentVolumeSource $rbd = null;

    /**
     * ScaleIO represents a ScaleIO persistent volume attached and mounted on
     * Kubernetes nodes.
     *
     * @var ScaleIOPersistentVolumeSource|null
     */
    private ?ScaleIOPersistentVolumeSource $scaleIO = null;

    /**
     * Name of StorageClass to which this persistent volume belongs. Empty value means
     * that this volume does not belong to any StorageClass.
     *
     * @var string|null
     */
    private ?string $storageClassName = null;

    /**
     * StorageOS represents a StorageOS volume that is attached to the kubelet's host
     * machine and mounted into the pod More info:
     * https://examples.k8s.io/volumes/storageos/README.md
     */
    private StorageOSPersistentVolumeSource $storageos;

    /**
     * volumeMode defines if a volume is intended to be used with a formatted
     * filesystem or to remain in raw block state. Value of Filesystem is implied when
     * not included in spec. This is a beta feature.
     *
     * @var string|null
     */
    private ?string $volumeMode = null;

    /**
     * VsphereVolume represents a vSphere volume attached and mounted on kubelets host
     * machine
     *
     * @var VsphereVirtualDiskVolumeSource|null
     */
    private ?VsphereVirtualDiskVolumeSource $vsphereVolume = null;

    public function __construct()
    {
        $this->accessModes = new StringList();
        $this->capacity = new QuantityMap();
        $this->cephfs = new CephFSPersistentVolumeSource();
        $this->claimRef = new ObjectReference();
        $this->fc = new FCVolumeSource();
        $this->flocker = new FlockerVolumeSource();
        $this->mountOptions = new StringList();
        $this->nodeAffinity = new VolumeNodeAffinity();
        $this->storageos = new StorageOSPersistentVolumeSource();
    }

    public function accessModes(): StringList
    {
        return $this->accessModes;
    }

    public function capacity(): QuantityMap
    {
        return $this->capacity;
    }

    public function cephfs(): CephFSPersistentVolumeSource
    {
        return $this->cephfs;
    }

    public function claimRef(): ObjectReference
    {
        return $this->claimRef;
    }

    public function fc(): FCVolumeSource
    {
        return $this->fc;
    }

    public function flocker(): FlockerVolumeSource
    {
        return $this->flocker;
    }

    /**
     * @return AWSElasticBlockStoreVolumeSource|null
     */
    public function getAwsElasticBlockStore(): ?AWSElasticBlockStoreVolumeSource
    {
        return $this->awsElasticBlockStore;
    }

    /**
     * @return AzureDiskVolumeSource|null
     */
    public function getAzureDisk(): ?AzureDiskVolumeSource
    {
        return $this->azureDisk;
    }

    /**
     * @return AzureFilePersistentVolumeSource|null
     */
    public function getAzureFile(): ?AzureFilePersistentVolumeSource
    {
        return $this->azureFile;
    }

    /**
     * @return CinderPersistentVolumeSource|null
     */
    public function getCinder(): ?CinderPersistentVolumeSource
    {
        return $this->cinder;
    }

    /**
     * @return CSIPersistentVolumeSource|null
     */
    public function getCsi(): ?CSIPersistentVolumeSource
    {
        return $this->csi;
    }

    /**
     * @return FlexPersistentVolumeSource|null
     */
    public function getFlexVolume(): ?FlexPersistentVolumeSource
    {
        return $this->flexVolume;
    }

    /**
     * @return GCEPersistentDiskVolumeSource|null
     */
    public function getGcePersistentDisk(): ?GCEPersistentDiskVolumeSource
    {
        return $this->gcePersistentDisk;
    }

    /**
     * @return GlusterfsPersistentVolumeSource|null
     */
    public function getGlusterfs(): ?GlusterfsPersistentVolumeSource
    {
        return $this->glusterfs;
    }

    /**
     * @return HostPathVolumeSource|null
     */
    public function getHostPath(): ?HostPathVolumeSource
    {
        return $this->hostPath;
    }

    /**
     * @return ISCSIPersistentVolumeSource|null
     */
    public function getIscsi(): ?ISCSIPersistentVolumeSource
    {
        return $this->iscsi;
    }

    /**
     * @return LocalVolumeSource|null
     */
    public function getLocal(): ?LocalVolumeSource
    {
        return $this->local;
    }

    /**
     * @return NFSVolumeSource|null
     */
    public function getNfs(): ?NFSVolumeSource
    {
        return $this->nfs;
    }

    /**
     * @return string|null
     */
    public function getPersistentVolumeReclaimPolicy(): ?string
    {
        return $this->persistentVolumeReclaimPolicy;
    }

    /**
     * @return PhotonPersistentDiskVolumeSource|null
     */
    public function getPhotonPersistentDisk(): ?PhotonPersistentDiskVolumeSource
    {
        return $this->photonPersistentDisk;
    }

    /**
     * @return PortworxVolumeSource|null
     */
    public function getPortworxVolume(): ?PortworxVolumeSource
    {
        return $this->portworxVolume;
    }

    /**
     * @return QuobyteVolumeSource|null
     */
    public function getQuobyte(): ?QuobyteVolumeSource
    {
        return $this->quobyte;
    }

    /**
     * @return RBDPersistentVolumeSource|null
     */
    public function getRbd(): ?RBDPersistentVolumeSource
    {
        return $this->rbd;
    }

    /**
     * @return ScaleIOPersistentVolumeSource|null
     */
    public function getScaleIO(): ?ScaleIOPersistentVolumeSource
    {
        return $this->scaleIO;
    }

    /**
     * @return string|null
     */
    public function getStorageClassName(): ?string
    {
        return $this->storageClassName;
    }

    /**
     * @return string|null
     */
    public function getVolumeMode(): ?string
    {
        return $this->volumeMode;
    }

    /**
     * @return VsphereVirtualDiskVolumeSource|null
     */
    public function getVsphereVolume(): ?VsphereVirtualDiskVolumeSource
    {
        return $this->vsphereVolume;
    }

    public function mountOptions(): StringList
    {
        return $this->mountOptions;
    }

    public function nodeAffinity(): VolumeNodeAffinity
    {
        return $this->nodeAffinity;
    }

    public function setAwsElasticBlockStore(AWSElasticBlockStoreVolumeSource $awsElasticBlockStore): self
    {
        $this->awsElasticBlockStore = $awsElasticBlockStore;

        return $this;
    }

    public function setAzureDisk(AzureDiskVolumeSource $azureDisk): self
    {
        $this->azureDisk = $azureDisk;

        return $this;
    }

    public function setAzureFile(AzureFilePersistentVolumeSource $azureFile): self
    {
        $this->azureFile = $azureFile;

        return $this;
    }

    public function setCinder(CinderPersistentVolumeSource $cinder): self
    {
        $this->cinder = $cinder;

        return $this;
    }

    public function setCsi(CSIPersistentVolumeSource $csi): self
    {
        $this->csi = $csi;

        return $this;
    }

    public function setFlexVolume(FlexPersistentVolumeSource $flexVolume): self
    {
        $this->flexVolume = $flexVolume;

        return $this;
    }

    public function setGcePersistentDisk(GCEPersistentDiskVolumeSource $gcePersistentDisk): self
    {
        $this->gcePersistentDisk = $gcePersistentDisk;

        return $this;
    }

    public function setGlusterfs(GlusterfsPersistentVolumeSource $glusterfs): self
    {
        $this->glusterfs = $glusterfs;

        return $this;
    }

    public function setHostPath(HostPathVolumeSource $hostPath): self
    {
        $this->hostPath = $hostPath;

        return $this;
    }

    public function setIscsi(ISCSIPersistentVolumeSource $iscsi): self
    {
        $this->iscsi = $iscsi;

        return $this;
    }

    public function setLocal(LocalVolumeSource $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function setNfs(NFSVolumeSource $nfs): self
    {
        $this->nfs = $nfs;

        return $this;
    }

    public function setPersistentVolumeReclaimPolicy(string $persistentVolumeReclaimPolicy): self
    {
        $this->persistentVolumeReclaimPolicy = $persistentVolumeReclaimPolicy;

        return $this;
    }

    public function setPhotonPersistentDisk(PhotonPersistentDiskVolumeSource $photonPersistentDisk): self
    {
        $this->photonPersistentDisk = $photonPersistentDisk;

        return $this;
    }

    public function setPortworxVolume(PortworxVolumeSource $portworxVolume): self
    {
        $this->portworxVolume = $portworxVolume;

        return $this;
    }

    public function setQuobyte(QuobyteVolumeSource $quobyte): self
    {
        $this->quobyte = $quobyte;

        return $this;
    }

    public function setRbd(RBDPersistentVolumeSource $rbd): self
    {
        $this->rbd = $rbd;

        return $this;
    }

    public function setScaleIO(ScaleIOPersistentVolumeSource $scaleIO): self
    {
        $this->scaleIO = $scaleIO;

        return $this;
    }

    public function setStorageClassName(string $storageClassName): self
    {
        $this->storageClassName = $storageClassName;

        return $this;
    }

    public function setVolumeMode(string $volumeMode): self
    {
        $this->volumeMode = $volumeMode;

        return $this;
    }

    public function setVsphereVolume(VsphereVirtualDiskVolumeSource $vsphereVolume): self
    {
        $this->vsphereVolume = $vsphereVolume;

        return $this;
    }

    public function storageos(): StorageOSPersistentVolumeSource
    {
        return $this->storageos;
    }

    public function jsonSerialize()
    {
        return [
            'accessModes' => $this->accessModes,
            'awsElasticBlockStore' => $this->awsElasticBlockStore,
            'azureDisk' => $this->azureDisk,
            'azureFile' => $this->azureFile,
            'capacity' => $this->capacity,
            'cephfs' => $this->cephfs,
            'cinder' => $this->cinder,
            'claimRef' => $this->claimRef,
            'csi' => $this->csi,
            'fc' => $this->fc,
            'flexVolume' => $this->flexVolume,
            'flocker' => $this->flocker,
            'gcePersistentDisk' => $this->gcePersistentDisk,
            'glusterfs' => $this->glusterfs,
            'hostPath' => $this->hostPath,
            'iscsi' => $this->iscsi,
            'local' => $this->local,
            'mountOptions' => $this->mountOptions,
            'nfs' => $this->nfs,
            'nodeAffinity' => $this->nodeAffinity,
            'persistentVolumeReclaimPolicy' => $this->persistentVolumeReclaimPolicy,
            'photonPersistentDisk' => $this->photonPersistentDisk,
            'portworxVolume' => $this->portworxVolume,
            'quobyte' => $this->quobyte,
            'rbd' => $this->rbd,
            'scaleIO' => $this->scaleIO,
            'storageClassName' => $this->storageClassName,
            'storageos' => $this->storageos,
            'volumeMode' => $this->volumeMode,
            'vsphereVolume' => $this->vsphereVolume,
        ];
    }
}
