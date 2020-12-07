<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * WebhookClientConfig contains the information to make a TLS connection with the
 * webhook
 */
class WebhookClientConfig implements JsonSerializable
{
    /**
     * `caBundle` is a PEM encoded CA bundle which will be used to validate the
     * webhook's server certificate. If unspecified, system trust roots on the
     * apiserver are used.
     */
    private string|null $caBundle = null;

    /**
     * `service` is a reference to the service for this webhook. Either `service` or
     * `url` must be specified.
     *
     * If the webhook is running within the cluster, then you should use `service`.
     */
    private ServiceReference|null $service = null;

    /**
     * `url` gives the location of the webhook, in standard URL form
     * (`scheme://host:port/path`). Exactly one of `url` or `service` must be
     * specified.
     *
     * The `host` should not refer to a service running in the cluster; use the
     * `service` field instead. The host might be resolved via external DNS in some
     * apiservers (e.g., `kube-apiserver` cannot resolve in-cluster DNS as that would
     * be a layering violation). `host` may also be an IP address.
     *
     * Please note that using `localhost` or `127.0.0.1` as a `host` is risky unless
     * you take great care to run this webhook on all hosts which run an apiserver
     * which might need to make calls to this webhook. Such installs are likely to be
     * non-portable, i.e., not easy to turn up in a new cluster.
     *
     * The scheme must be "https"; the URL must begin with "https://".
     *
     * A path is optional, and if present may be any string permissible in a URL. You
     * may use the path to pass an arbitrary string to the webhook, for example, a
     * cluster identifier.
     *
     * Attempting to use a user or basic auth e.g. "user:password@" is not allowed.
     * Fragments ("#...") and query parameters ("?...") are not allowed, either.
     */
    private string|null $url = null;

    public function __construct()
    {
    }

    public function getCaBundle(): string|null
    {
        return $this->caBundle;
    }

    public function getService(): ServiceReference|null
    {
        return $this->service;
    }

    public function getUrl(): string|null
    {
        return $this->url;
    }

    public function setCaBundle(string $caBundle): self
    {
        $this->caBundle = $caBundle;

        return $this;
    }

    public function setService(ServiceReference $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'caBundle' => $this->caBundle,
            'service' => $this->service,
            'url' => $this->url,
        ];
    }
}
