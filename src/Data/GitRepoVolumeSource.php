<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a volume that is populated with the contents of a git repository. Git
 * repo volumes do not support ownership management. Git repo volumes support
 * SELinux relabeling.
 *
 * DEPRECATED: GitRepo is deprecated. To provision a container with a git repo,
 * mount an EmptyDir into an InitContainer that clones the repo using git, then
 * mount the EmptyDir into the Pod's container.
 */
class GitRepoVolumeSource implements JsonSerializable
{
    /**
     * Target directory name. Must not contain or start with '..'.  If '.' is supplied,
     * the volume directory will be the git repository.  Otherwise, if specified, the
     * volume will contain the git repository in the subdirectory with the given name.
     *
     * @var string|null
     */
    private ?string $directory = null;

    /**
     * Repository URL
     */
    private string $repository;

    /**
     * Commit hash for the specified revision.
     *
     * @var string|null
     */
    private ?string $revision = null;

    public function __construct(string $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string|null
     */
    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function getRepository(): string
    {
        return $this->repository;
    }

    /**
     * @return string|null
     */
    public function getRevision(): ?string
    {
        return $this->revision;
    }

    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;

        return $this;
    }

    public function setRepository(string $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function setRevision(string $revision): self
    {
        $this->revision = $revision;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'directory' => $this->directory,
            'repository' => $this->repository,
            'revision' => $this->revision,
        ];
    }
}
