<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\IntOrString;
use JsonSerializable;

/**
 * TCPSocketAction describes an action based on opening a socket
 */
class TCPSocketAction implements JsonSerializable
{
    /**
     * Optional: Host name to connect to, defaults to the pod IP.
     *
     * @var string|null
     */
    private ?string $host = null;

    /**
     * Number or name of the port to access on the container. Number must be in the
     * range 1 to 65535. Name must be an IANA_SVC_NAME.
     */
    private IntOrString $port;

    public function __construct(IntOrString $port)
    {
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    public function getPort(): IntOrString
    {
        return $this->port;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function setPort(IntOrString $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'host' => $this->host,
            'port' => $this->port,
        ];
    }
}
