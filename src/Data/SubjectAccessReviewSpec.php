<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringListMap;
use JsonSerializable;

/**
 * SubjectAccessReviewSpec is a description of the access request.  Exactly one of
 * ResourceAuthorizationAttributes and NonResourceAuthorizationAttributes must be
 * set
 */
class SubjectAccessReviewSpec implements JsonSerializable
{
    /**
     * Extra corresponds to the user.Info.GetExtra() method from the authenticator.
     * Since that is input to the authorizer it needs a reflection here.
     */
    private StringListMap $extra;

    /**
     * Groups is the groups you're testing for.
     */
    private StringList $groups;

    /**
     * NonResourceAttributes describes information for a non-resource access request
     */
    private NonResourceAttributes $nonResourceAttributes;

    /**
     * ResourceAuthorizationAttributes describes information for a resource access
     * request
     */
    private ResourceAttributes $resourceAttributes;

    /**
     * UID information about the requesting user.
     *
     * @var string|null
     */
    private ?string $uid = null;

    /**
     * User is the user you're testing for. If you specify "User" but not "Groups",
     * then is it interpreted as "What if User were not a member of any groups
     *
     * @var string|null
     */
    private ?string $user = null;

    public function __construct()
    {
        $this->extra = new StringListMap();
        $this->groups = new StringList();
        $this->nonResourceAttributes = new NonResourceAttributes();
        $this->resourceAttributes = new ResourceAttributes();
    }

    public function extra(): StringListMap
    {
        return $this->extra;
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
    public function getUser(): ?string
    {
        return $this->user;
    }

    public function groups(): StringList
    {
        return $this->groups;
    }

    public function nonResourceAttributes(): NonResourceAttributes
    {
        return $this->nonResourceAttributes;
    }

    public function resourceAttributes(): ResourceAttributes
    {
        return $this->resourceAttributes;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'extra' => $this->extra,
            'groups' => $this->groups,
            'nonResourceAttributes' => $this->nonResourceAttributes,
            'resourceAttributes' => $this->resourceAttributes,
            'uid' => $this->uid,
            'user' => $this->user,
        ];
    }
}
