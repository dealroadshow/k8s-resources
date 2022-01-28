<?php

declare(strict_types=1);

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
     */
    private int|null $failureThreshold = null;

    /**
     * HTTPGet specifies the http request to perform.
     */
    private HTTPGetAction|null $httpGet = null;

    /**
     * Number of seconds after the container has started before liveness probes are
     * initiated. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
     */
    private int|null $initialDelaySeconds = null;

    /**
     * How often (in seconds) to perform the probe. Default to 10 seconds. Minimum
     * value is 1.
     */
    private int|null $periodSeconds = null;

    /**
     * Minimum consecutive successes for the probe to be considered successful after
     * having failed. Defaults to 1. Must be 1 for liveness and startup. Minimum value
     * is 1.
     */
    private int|null $successThreshold = null;

    /**
     * TCPSocket specifies an action involving a TCP port. TCP hooks not yet supported
     */
    private TCPSocketAction|null $tcpSocket = null;

    /**
     * Optional duration in seconds the pod needs to terminate gracefully upon probe
     * failure. The grace period is the duration in seconds after the processes running
     * in the pod are sent a termination signal and the time when the processes are
     * forcibly halted with a kill signal. Set this value longer than the expected
     * cleanup time for your process. If this value is nil, the pod's
     * terminationGracePeriodSeconds will be used. Otherwise, this value overrides the
     * value provided by the pod spec. Value must be non-negative integer. The value
     * zero indicates stop immediately via the kill signal (no opportunity to shut
     * down). This is an alpha field and requires enabling ProbeTerminationGracePeriod
     * feature gate.
     */
    private int|null $terminationGracePeriodSeconds = null;

    /**
     * Number of seconds after which the probe times out. Defaults to 1 second. Minimum
     * value is 1. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#container-probes
     */
    private int|null $timeoutSeconds = null;

    public function __construct()
    {
        $this->exec = new ExecAction();
    }

    public function exec(): ExecAction
    {
        return $this->exec;
    }

    public function getFailureThreshold(): int|null
    {
        return $this->failureThreshold;
    }

    public function getHttpGet(): HTTPGetAction|null
    {
        return $this->httpGet;
    }

    public function getInitialDelaySeconds(): int|null
    {
        return $this->initialDelaySeconds;
    }

    public function getPeriodSeconds(): int|null
    {
        return $this->periodSeconds;
    }

    public function getSuccessThreshold(): int|null
    {
        return $this->successThreshold;
    }

    public function getTcpSocket(): TCPSocketAction|null
    {
        return $this->tcpSocket;
    }

    public function getTerminationGracePeriodSeconds(): int|null
    {
        return $this->terminationGracePeriodSeconds;
    }

    public function getTimeoutSeconds(): int|null
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

    public function setTerminationGracePeriodSeconds(int $terminationGracePeriodSeconds): self
    {
        $this->terminationGracePeriodSeconds = $terminationGracePeriodSeconds;

        return $this;
    }

    public function setTimeoutSeconds(int $timeoutSeconds): self
    {
        $this->timeoutSeconds = $timeoutSeconds;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'exec' => $this->exec,
            'failureThreshold' => $this->failureThreshold,
            'httpGet' => $this->httpGet,
            'initialDelaySeconds' => $this->initialDelaySeconds,
            'periodSeconds' => $this->periodSeconds,
            'successThreshold' => $this->successThreshold,
            'tcpSocket' => $this->tcpSocket,
            'terminationGracePeriodSeconds' => $this->terminationGracePeriodSeconds,
            'timeoutSeconds' => $this->timeoutSeconds,
        ];
    }
}
