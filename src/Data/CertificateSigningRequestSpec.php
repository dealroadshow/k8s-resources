<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringListMap;
use JsonSerializable;

/**
 * This information is immutable after the request is created. Only the Request and
 * Usages fields can be set on creation, other fields are derived by Kubernetes and
 * cannot be modified by users.
 */
class CertificateSigningRequestSpec implements JsonSerializable
{
    /**
     * Extra information about the requesting user. See user.Info interface for
     * details.
     */
    private StringListMap $extra;

    /**
     * Group information about the requesting user. See user.Info interface for
     * details.
     */
    private StringList $groups;

    /**
     * Base64-encoded PKCS#10 CSR data
     */
    private string $request;

    /**
     * UID information about the requesting user. See user.Info interface for details.
     *
     * @var string|null
     */
    private ?string $uid = null;

    /**
     * allowedUsages specifies a set of usage contexts the key will be valid for. See:
     * https://tools.ietf.org/html/rfc5280#section-4.2.1.3
     *      https://tools.ietf.org/html/rfc5280#section-4.2.1.12
     */
    private StringList $usages;

    /**
     * Information about the requesting user. See user.Info interface for details.
     *
     * @var string|null
     */
    private ?string $username = null;

    public function __construct(string $request)
    {
        $this->extra = new StringListMap();
        $this->groups = new StringList();
        $this->request = $request;
        $this->usages = new StringList();
    }

    public function extra(): StringListMap
    {
        return $this->extra;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function groups(): StringList
    {
        return $this->groups;
    }

    public function setRequest(string $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function usages(): StringList
    {
        return $this->usages;
    }

    public function jsonSerialize()
    {
        return [
            'extra' => $this->extra,
            'groups' => $this->groups,
            'request' => $this->request,
            'uid' => $this->uid,
            'usages' => $this->usages,
            'username' => $this->username,
        ];
    }
}
