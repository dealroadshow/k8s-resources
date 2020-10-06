<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Probe describes a health check to be performed against a container to determine
 * whether it is alive or ready to receive traffic.
 */
class Probe implements JsonSerializable
{
    /**
     * One and only one of the following should be specified. Exec specifies the action
     * to take.
     */
    private ExecAction $exec;

    /**
     * Minimum consecutive failures for the probe to be considered failed after having
     * succeeded. Defaults to 3. Minimum value is 1.
     *
     * @var int|null
     */
    private ?int $failureThreshold = null;

    /**
     * HTTPGet specifies the http request to perform.
     *
     * @var HTTPGetAction|null
     */
    private ?HTTPGetAction $httpGet = null;

    /**
     * Number of seconds after the container has started before liveness probes are
     * initiated. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
     *
     * @var int|null
     */
    private ?int $initialDelaySeconds = null;

    /**
     * How often (in seconds) to perform the probe. Default to 10 seconds. Minimum
     * value is 1.
     *
     * @var int|null
     */
    private ?int $periodSeconds = null;

    /**
     * Minimum consecutive successes for the probe to be considered successful after
     * having failed. Defaults to 1. Must be 1 for liveness and startup. Minimum value
     * is 1.
     *
     * @var int|null
     */
    private ?int $successThreshold = null;

    /**
     * TCPSocket specifies an action involving a TCP port. TCP hooks not yet supported
     *
     * @var TCPSocketAction|null
     */
    private ?TCPSocketAction $tcpSocket = null;

    /**
     * Number of seconds after which the probe times out. Defaults to 1 second. Minimum
     * value is 1. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
     *
     * @var int|null
     */
    private ?int $timeoutSeconds = null;

    public function __construct()
    {
        $this->exec = new ExecAction();
    }

    public function exec(): ExecAction
    {
        return $this->exec;
    }

    /**
     * @return int|null
     */
    public function getFailureThreshold(): ?int
    {
        return $this->failureThreshold;
    }

    /**
     * @return HTTPGetAction|null
     */
    public function getHttpGet(): ?HTTPGetAction
    {
        return $this->httpGet;
    }

    /**
     * @return int|null
     */
    public function getInitialDelaySeconds(): ?int
    {
        return $this->initialDelaySeconds;
    }

    /**
     * @return int|null
     */
    public function getPeriodSeconds(): ?int
    {
        return $this->periodSeconds;
    }

    /**
     * @return int|null
     */
    public function getSuccessThreshold(): ?int
    {
        return $this->successThreshold;
    }

    /**
     * @return TCPSocketAction|null
     */
    public function getTcpSocket(): ?TCPSocketAction
    {
        return $this->tcpSocket;
    }

    /**
     * @return int|null
     */
    public function getTimeoutSeconds(): ?int
    {
        return $this->timeoutSeconds;
    }

    public function setFailureThreshold(int $failureThreshold): self
    {
        $this->failureThreshold = $failureThreshold;

        return $this;
    }

    public function setHttpGet(HTTPGetAction $httpGet): self
    {
        $this->httpGet = $httpGet;

        return $this;
    }

    public function setInitialDelaySeconds(int $initialDelaySeconds): self
    {
        $this->initialDelaySeconds = $initialDelaySeconds;

        return $this;
    }

    public function setPeriodSeconds(int $periodSeconds): self
    {
        $this->periodSeconds = $periodSeconds;

        return $this;
    }

    public function setSuccessThreshold(int $successThreshold): self
    {
        $this->successThreshold = $successThreshold;

        return $this;
    }

    public function setTcpSocket(TCPSocketAction $tcpSocket): self
    {
        $this->tcpSocket = $tcpSocket;

        return $this;
    }

    public function setTimeoutSeconds(int $timeoutSeconds): self
    {
        $this->timeoutSeconds = $timeoutSeconds;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'exec' => $this->exec,
            'failureThreshold' => $this->failureThreshold,
            'httpGet' => $this->httpGet,
            'initialDelaySeconds' => $this->initialDelaySeconds,
            'periodSeconds' => $this->periodSeconds,
            'successThreshold' => $this->successThreshold,
            'tcpSocket' => $this->tcpSocket,
            'timeoutSeconds' => $this->timeoutSeconds,
        ];
    }
}
