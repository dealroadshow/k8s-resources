<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Volume represents a named volume in a pod that may be accessed by any container
 * in the pod.
 */
class Volume implements JsonSerializable
{
    /**
     * AWSElasticBlockStore represents an AWS Disk resource that is attached to a
     * kubelet's host machine and then exposed to the pod. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#awselasticblockstore
     */
    private AWSElasticBlockStoreVolumeSource|null $awsElasticBlockStore = null;

    /**
     * AzureDisk represents an Azure Data Disk mount on the host and bind mount to the
     * pod.
     */
    private AzureDiskVolumeSource|null $azureDisk = null;

    /**
     * AzureFile represents an Azure File Service mount on the host and bind mount to
     * the pod.
     */
    private AzureFileVolumeSource|null $azureFile = null;

    /**
     * CephFS represents a Ceph FS mount on the host that shares a pod's lifetime
     */
    private CephFSVolumeSource $cephfs;

    /**
     * Cinder represents a cinder volume attached and mounted on kubelets host machine.
     * More info: https://examples.k8s.io/mysql-cinder-pd/README.md
     */
    private CinderVolumeSource|null $cinder = null;

    /**
     * ConfigMap represents a configMap that should populate this volume
     */
    private ConfigMapVolumeSource $configMap;

    /**
     * CSI (Container Storage Interface) represents storage that is handled by an
     * external CSI driver (Alpha feature).
     */
    private CSIVolumeSource|null $csi = null;

    /**
     * DownwardAPI represents downward API about the pod that should populate this
     * volume
     */
    private DownwardAPIVolumeSource $downwardAPI;

    /**
     * EmptyDir represents a temporary directory that shares a pod's lifetime. More
     * info: https://kubernetes.io/docs/concepts/storage/volumes#emptydir
     */
    private EmptyDirVolumeSource $emptyDir;

    /**
     * FC represents a Fibre Channel resource that is attached to a kubelet's host
     * machine and then exposed to the pod.
     */
    private FCVolumeSource $fc;

    /**
     * FlexVolume represents a generic volume resource that is provisioned/attached
     * using an exec based plugin.
     */
    private FlexVolumeSource|null $flexVolume = null;

    /**
     * Flocker represents a Flocker volume attached to a kubelet's host machine. This
     * depends on the Flocker control service being running
     */
    private FlockerVolumeSource $flocker;

    /**
     * GCEPersistentDisk represents a GCE Disk resource that is attached to a kubelet's
     * host machine and then exposed to the pod. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private GCEPersistentDiskVolumeSource|null $gcePersistentDisk = null;

    /**
     * GitRepo represents a git repository at a particular revision. DEPRECATED:
     * GitRepo is deprecated. To provision a container with a git repo, mount an
     * EmptyDir into an InitContainer that clones the repo using git, then mount the
     * EmptyDir into the Pod's container.
     */
    private GitRepoVolumeSource|null $gitRepo = null;

    /**
     * Glusterfs represents a Glusterfs mount on the host that shares a pod's lifetime.
     * More info: https://examples.k8s.io/volumes/glusterfs/README.md
     */
    private GlusterfsVolumeSource|null $glusterfs = null;

    /**
     * HostPath represents a pre-existing file or directory on the host machine that is
     * directly exposed to the container. This is generally used for system agents or
     * other privileged things that are allowed to see the host machine. Most
     * containers will NOT need this. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#hostpath
     */
    private HostPathVolumeSource|null $hostPath = null;

    /**
     * ISCSI represents an ISCSI Disk resource that is attached to a kubelet's host
     * machine and then exposed to the pod. More info:
     * https://examples.k8s.io/volumes/iscsi/README.md
     */
    private ISCSIVolumeSource|null $iscsi = null;

    /**
     * Volume's name. Must be a DNS_LABEL and unique within the pod. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string $name;

    /**
     * NFS represents an NFS mount on the host that shares a pod's lifetime More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     */
    private NFSVolumeSource|null $nfs = null;

    /**
     * PersistentVolumeClaimVolumeSource represents a reference to a
     * PersistentVolumeClaim in the same namespace. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#persistentvolumeclaims
     */
    private PersistentVolumeClaimVolumeSource|null $persistentVolumeClaim = null;

    /**
     * PhotonPersistentDisk represents a PhotonController persistent disk attached and
     * mounted on kubelets host machine
     */
    private PhotonPersistentDiskVolumeSource|null $photonPersistentDisk = null;

    /**
     * PortworxVolume represents a portworx volume attached and mounted on kubelets
     * host machine
     */
    private PortworxVolumeSource|null $portworxVolume = null;

    /**
     * Items for all in one resources secrets, configmaps, and downward API
     */
    private ProjectedVolumeSource $projected;

    /**
     * Quobyte represents a Quobyte mount on the host that shares a pod's lifetime
     */
    private QuobyteVolumeSource|null $quobyte = null;

    /**
     * RBD represents a Rados Block Device mount on the host that shares a pod's
     * lifetime. More info: https://examples.k8s.io/volumes/rbd/README.md
     */
    private RBDVolumeSource|null $rbd = null;

    /**
     * ScaleIO represents a ScaleIO persistent volume attached and mounted on
     * Kubernetes nodes.
     */
    private ScaleIOVolumeSource|null $scaleIO = null;

    /**
     * Secret represents a secret that should populate this volume. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#secret
     */
    private SecretVolumeSource $secret;

    /**
     * StorageOS represents a StorageOS volume attached and mounted on Kubernetes
     * nodes.
     */
    private StorageOSVolumeSource $storageos;

    /**
     * VsphereVolume represents a vSphere volume attached and mounted on kubelets host
     * machine
     */
    private VsphereVirtualDiskVolumeSource|null $vsphereVolume = null;

    public function __construct(string $name)
    {
        $this->cephfs = new CephFSVolumeSource();
        $this->configMap = new ConfigMapVolumeSource();
        $this->downwardAPI = new DownwardAPIVolumeSource();
        $this->emptyDir = new EmptyDirVolumeSource();
        $this->fc = new FCVolumeSource();
        $this->flocker = new FlockerVolumeSource();
        $this->name = $name;
        $this->projected = new ProjectedVolumeSource();
        $this->secret = new SecretVolumeSource();
        $this->storageos = new StorageOSVolumeSource();
    }

    public function cephfs(): CephFSVolumeSource
    {
        return $this->cephfs;
    }

    public function configMap(): ConfigMapVolumeSource
    {
        return $this->configMap;
    }

    public function downwardAPI(): DownwardAPIVolumeSource
    {
        return $this->downwardAPI;
    }

    public function emptyDir(): EmptyDirVolumeSource
    {
        return $this->emptyDir;
    }

    public function fc(): FCVolumeSource
    {
        return $this->fc;
    }

    public function flocker(): FlockerVolumeSource
    {
        return $this->flocker;
    }

    public function getAwsElasticBlockStore(): AWSElasticBlockStoreVolumeSource|null
    {
        return $this->awsElasticBlockStore;
    }

    public function getAzureDisk(): AzureDiskVolumeSource|null
    {
        return $this->azureDisk;
    }

    public function getAzureFile(): AzureFileVolumeSource|null
    {
        return $this->azureFile;
    }

    public function getCinder(): CinderVolumeSource|null
    {
        return $this->cinder;
    }

    public function getCsi(): CSIVolumeSource|null
    {
        return $this->csi;
    }

    public function getFlexVolume(): FlexVolumeSource|null
    {
        return $this->flexVolume;
    }

    public function getGcePersistentDisk(): GCEPersistentDiskVolumeSource|null
    {
        return $this->gcePersistentDisk;
    }

    public function getGitRepo(): GitRepoVolumeSource|null
    {
        return $this->gitRepo;
    }

    public function getGlusterfs(): GlusterfsVolumeSource|null
    {
        return $this->glusterfs;
    }

    public function getHostPath(): HostPathVolumeSource|null
    {
        return $this->hostPath;
    }

    public function getIscsi(): ISCSIVolumeSource|null
    {
        return $this->iscsi;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNfs(): NFSVolumeSource|null
    {
        return $this->nfs;
    }

    public function getPersistentVolumeClaim(): PersistentVolumeClaimVolumeSource|null
    {
        return $this->persistentVolumeClaim;
    }

    public function getPhotonPersistentDisk(): PhotonPersistentDiskVolumeSource|null
    {
        return $this->photonPersistentDisk;
    }

    public function getPortworxVolume(): PortworxVolumeSource|null
    {
        return $this->portworxVolume;
    }

    public function getQuobyte(): QuobyteVolumeSource|null
    {
        return $this->quobyte;
    }

    public function getRbd(): RBDVolumeSource|null
    {
        return $this->rbd;
    }

    public function getScaleIO(): ScaleIOVolumeSource|null
    {
        return $this->scaleIO;
    }

    public function getVsphereVolume(): VsphereVirtualDiskVolumeSource|null
    {
        return $this->vsphereVolume;
    }

    public function projected(): ProjectedVolumeSource
    {
        return $this->projected;
    }

    public function secret(): SecretVolumeSource
    {
        return $this->secret;
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

    public function setAzureFile(AzureFileVolumeSource $azureFile): self
    {
        $this->azureFile = $azureFile;

        return $this;
    }

    public function setCinder(CinderVolumeSource $cinder): self
    {
        $this->cinder = $cinder;

        return $this;
    }

    public function setCsi(CSIVolumeSource $csi): self
    {
        $this->csi = $csi;

        return $this;
    }

    public function setFlexVolume(FlexVolumeSource $flexVolume): self
    {
        $this->flexVolume = $flexVolume;

        return $this;
    }

    public function setGcePersistentDisk(GCEPersistentDiskVolumeSource $gcePersistentDisk): self
    {
        $this->gcePersistentDisk = $gcePersistentDisk;

        return $this;
    }

    public function setGitRepo(GitRepoVolumeSource $gitRepo): self
    {
        $this->gitRepo = $gitRepo;

        return $this;
    }

    public function setGlusterfs(GlusterfsVolumeSource $glusterfs): self
    {
        $this->glusterfs = $glusterfs;

        return $this;
    }

    public function setHostPath(HostPathVolumeSource $hostPath): self
    {
        $this->hostPath = $hostPath;

        return $this;
    }

    public function setIscsi(ISCSIVolumeSource $iscsi): self
    {
        $this->iscsi = $iscsi;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNfs(NFSVolumeSource $nfs): self
    {
        $this->nfs = $nfs;

        return $this;
    }

    public function setPersistentVolumeClaim(PersistentVolumeClaimVolumeSource $persistentVolumeClaim): self
    {
        $this->persistentVolumeClaim = $persistentVolumeClaim;

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

    public function setRbd(RBDVolumeSource $rbd): self
    {
        $this->rbd = $rbd;

        return $this;
    }

    public function setScaleIO(ScaleIOVolumeSource $scaleIO): self
    {
        $this->scaleIO = $scaleIO;

        return $this;
    }

    public function setVsphereVolume(VsphereVirtualDiskVolumeSource $vsphereVolume): self
    {
        $this->vsphereVolume = $vsphereVolume;

        return $this;
    }

    public function storageos(): StorageOSVolumeSource
    {
        return $this->storageos;
    }

    public function jsonSerialize(): array
    {
        return [
            'awsElasticBlockStore' => $this->awsElasticBlockStore,
            'azureDisk' => $this->azureDisk,
            'azureFile' => $this->azureFile,
            'cephfs' => $this->cephfs,
            'cinder' => $this->cinder,
            'configMap' => $this->configMap,
            'csi' => $this->csi,
            'downwardAPI' => $this->downwardAPI,
            'emptyDir' => $this->emptyDir,
            'fc' => $this->fc,
            'flexVolume' => $this->flexVolume,
            'flocker' => $this->flocker,
            'gcePersistentDisk' => $this->gcePersistentDisk,
            'gitRepo' => $this->gitRepo,
            'glusterfs' => $this->glusterfs,
            'hostPath' => $this->hostPath,
            'iscsi' => $this->iscsi,
            'name' => $this->name,
            'nfs' => $this->nfs,
            'persistentVolumeClaim' => $this->persistentVolumeClaim,
            'photonPersistentDisk' => $this->photonPersistentDisk,
            'portworxVolume' => $this->portworxVolume,
            'projected' => $this->projected,
            'quobyte' => $this->quobyte,
            'rbd' => $this->rbd,
            'scaleIO' => $this->scaleIO,
            'secret' => $this->secret,
            'storageos' => $this->storageos,
            'vsphereVolume' => $this->vsphereVolume,
        ];
    }
}
