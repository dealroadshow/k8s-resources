<?php 

namespace Dealroadshow\K8S\API\Batch;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * CronJobList is a collection of cron jobs.
 */
class CronJobList implements APIResourceListInterface
{
    const API_VERSION = 'batch/v1';
    const KIND = 'CronJobList';

    /**
     * @var CronJob[]
     */
    private array $items = [];

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(CronJob $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var CronJob[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return CronJob[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
