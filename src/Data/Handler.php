<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Handler defines a specific action that should be taken
 */
class Handler implements JsonSerializable
{
    /**
     * One and only one of the following should be specified. Exec specifies the action
     * to take.
     */
    private ExecAction $exec;

    /**
     * HTTPGet specifies the http request to perform.
     */
    private HTTPGetAction|null $httpGet = null;

    /**
     * TCPSocket specifies an action involving a TCP port. TCP hooks not yet supported
     */
    private TCPSocketAction|null $tcpSocket = null;

    public function __construct()
    {
        $this->exec = new ExecAction();
    }

    public function exec(): ExecAction
    {
        return $this->exec;
    }

    public function getHttpGet(): HTTPGetAction|null
    {
        return $this->httpGet;
    }

    public function getTcpSocket(): TCPSocketAction|null
    {
        return $this->tcpSocket;
    }

    public function setHttpGet(HTTPGetAction $httpGet): self
    {
        $this->httpGet = $httpGet;

        return $this;
    }

    public function setTcpSocket(TCPSocketAction $tcpSocket): self
    {
        $this->tcpSocket = $tcpSocket;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'exec' => $this->exec,
            'httpGet' => $this->httpGet,
            'tcpSocket' => $this->tcpSocket,
        ];
    }
}
