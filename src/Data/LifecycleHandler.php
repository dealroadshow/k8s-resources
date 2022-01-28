<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * LifecycleHandler defines a specific action that should be taken in a lifecycle
 * hook. One and only one of the fields, except TCPSocket must be specified.
 */
class LifecycleHandler implements JsonSerializable
{
    /**
     * Exec specifies the action to take.
     */
    private ExecAction $exec;

    /**
     * HTTPGet specifies the http request to perform.
     */
    private HTTPGetAction|null $httpGet = null;

    /**
     * Deprecated. TCPSocket is NOT supported as a LifecycleHandler and kept for the
     * backward compatibility. There are no validation of this field and lifecycle
     * hooks will fail in runtime when tcp handler is specified.
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
