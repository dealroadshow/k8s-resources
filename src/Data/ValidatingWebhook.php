<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\RuleWithOperationsList;
use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * ValidatingWebhook describes an admission webhook and the resources and
 * operations it applies to.
 */
class ValidatingWebhook implements JsonSerializable
{
    /**
     * AdmissionReviewVersions is an ordered list of preferred `AdmissionReview`
     * versions the Webhook expects. API server will try to use first version in the
     * list which it supports. If none of the versions specified in this list supported
     * by API server, validation will fail for this object. If a persisted webhook
     * configuration specifies allowed versions and does not include any versions known
     * to the API Server, calls to the webhook will fail and be subject to the failure
     * policy.
     */
    private StringList $admissionReviewVersions;

    /**
     * ClientConfig defines how to communicate with the hook. Required
     */
    private WebhookClientConfig $clientConfig;

    /**
     * FailurePolicy defines how unrecognized errors from the admission endpoint are
     * handled - allowed values are Ignore or Fail. Defaults to Fail.
     */
    private string|null $failurePolicy = null;

    /**
     * matchPolicy defines how the "rules" list is used to match incoming requests.
     * Allowed values are "Exact" or "Equivalent".
     *
     * - Exact: match a request only if it exactly matches a specified rule. For
     * example, if deployments can be modified via apps/v1, apps/v1beta1, and
     * extensions/v1beta1, but "rules" only included `apiGroups:["apps"],
     * apiVersions:["v1"], resources: ["deployments"]`, a request to apps/v1beta1 or
     * extensions/v1beta1 would not be sent to the webhook.
     *
     * - Equivalent: match a request if modifies a resource listed in rules, even via
     * another API group or version. For example, if deployments can be modified via
     * apps/v1, apps/v1beta1, and extensions/v1beta1, and "rules" only included
     * `apiGroups:["apps"], apiVersions:["v1"], resources: ["deployments"]`, a request
     * to apps/v1beta1 or extensions/v1beta1 would be converted to apps/v1 and sent to
     * the webhook.
     *
     * Defaults to "Equivalent"
     */
    private string|null $matchPolicy = null;

    /**
     * The name of the admission webhook. Name should be fully qualified, e.g.,
     * imagepolicy.kubernetes.io, where "imagepolicy" is the name of the webhook, and
     * kubernetes.io is the name of the organization. Required.
     */
    private string $name;

    /**
     * NamespaceSelector decides whether to run the webhook on an object based on
     * whether the namespace for that object matches the selector. If the object itself
     * is a namespace, the matching is performed on object.metadata.labels. If the
     * object is another cluster scoped resource, it never skips the webhook.
     *
     * For example, to run the webhook on any objects whose namespace is not associated
     * with "runlevel" of "0" or "1";  you will set the selector as follows:
     * "namespaceSelector": {
     *   "matchExpressions": [
     *     {
     *       "key": "runlevel",
     *       "operator": "NotIn",
     *       "values": [
     *         "0",
     *         "1"
     *       ]
     *     }
     *   ]
     * }
     *
     * If instead you want to only run the webhook on any objects whose namespace is
     * associated with the "environment" of "prod" or "staging"; you will set the
     * selector as follows: "namespaceSelector": {
     *   "matchExpressions": [
     *     {
     *       "key": "environment",
     *       "operator": "In",
     *       "values": [
     *         "prod",
     *         "staging"
     *       ]
     *     }
     *   ]
     * }
     *
     * See https://kubernetes.io/docs/concepts/overview/working-with-objects/labels for
     * more examples of label selectors.
     *
     * Default to the empty LabelSelector, which matches everything.
     */
    private LabelSelector $namespaceSelector;

    /**
     * ObjectSelector decides whether to run the webhook based on if the object has
     * matching labels. objectSelector is evaluated against both the oldObject and
     * newObject that would be sent to the webhook, and is considered to match if
     * either object matches the selector. A null object (oldObject in the case of
     * create, or newObject in the case of delete) or an object that cannot have labels
     * (like a DeploymentRollback or a PodProxyOptions object) is not considered to
     * match. Use the object selector only if the webhook is opt-in, because end users
     * may skip the admission webhook by setting the labels. Default to the empty
     * LabelSelector, which matches everything.
     */
    private LabelSelector $objectSelector;

    /**
     * Rules describes what operations on what resources/subresources the webhook cares
     * about. The webhook cares about an operation if it matches _any_ Rule. However,
     * in order to prevent ValidatingAdmissionWebhooks and MutatingAdmissionWebhooks
     * from putting the cluster in a state which cannot be recovered from without
     * completely disabling the plugin, ValidatingAdmissionWebhooks and
     * MutatingAdmissionWebhooks are never called on admission requests for
     * ValidatingWebhookConfiguration and MutatingWebhookConfiguration objects.
     */
    private RuleWithOperationsList $rules;

    /**
     * SideEffects states whether this webhook has side effects. Acceptable values are:
     * None, NoneOnDryRun (webhooks created via v1beta1 may also specify Some or
     * Unknown). Webhooks with side effects MUST implement a reconciliation system,
     * since a request may be rejected by a future step in the admission change and the
     * side effects therefore need to be undone. Requests with the dryRun attribute
     * will be auto-rejected if they match a webhook with sideEffects == Unknown or
     * Some.
     */
    private string $sideEffects;

    /**
     * TimeoutSeconds specifies the timeout for this webhook. After the timeout passes,
     * the webhook call will be ignored or the API call will fail based on the failure
     * policy. The timeout value must be between 1 and 30 seconds. Default to 10
     * seconds.
     */
    private int|null $timeoutSeconds = null;

    public function __construct(string $name, string $sideEffects)
    {
        $this->admissionReviewVersions = new StringList();
        $this->clientConfig = new WebhookClientConfig();
        $this->name = $name;
        $this->namespaceSelector = new LabelSelector();
        $this->objectSelector = new LabelSelector();
        $this->rules = new RuleWithOperationsList();
        $this->sideEffects = $sideEffects;
    }

    public function admissionReviewVersions(): StringList
    {
        return $this->admissionReviewVersions;
    }

    public function clientConfig(): WebhookClientConfig
    {
        return $this->clientConfig;
    }

    public function getFailurePolicy(): string|null
    {
        return $this->failurePolicy;
    }

    public function getMatchPolicy(): string|null
    {
        return $this->matchPolicy;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSideEffects(): string
    {
        return $this->sideEffects;
    }

    public function getTimeoutSeconds(): int|null
    {
        return $this->timeoutSeconds;
    }

    public function namespaceSelector(): LabelSelector
    {
        return $this->namespaceSelector;
    }

    public function objectSelector(): LabelSelector
    {
        return $this->objectSelector;
    }

    public function rules(): RuleWithOperationsList
    {
        return $this->rules;
    }

    public function setFailurePolicy(string $failurePolicy): self
    {
        $this->failurePolicy = $failurePolicy;

        return $this;
    }

    public function setMatchPolicy(string $matchPolicy): self
    {
        $this->matchPolicy = $matchPolicy;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setSideEffects(string $sideEffects): self
    {
        $this->sideEffects = $sideEffects;

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
            'admissionReviewVersions' => $this->admissionReviewVersions,
            'clientConfig' => $this->clientConfig,
            'failurePolicy' => $this->failurePolicy,
            'matchPolicy' => $this->matchPolicy,
            'name' => $this->name,
            'namespaceSelector' => $this->namespaceSelector,
            'objectSelector' => $this->objectSelector,
            'rules' => $this->rules,
            'sideEffects' => $this->sideEffects,
            'timeoutSeconds' => $this->timeoutSeconds,
        ];
    }
}
