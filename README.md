#Dealroadshow k8s resources

This repository contains PHP classes, corresponding to Kubernetes API definitions.
Classes in this repository are generated with [kodegen](https://github.com/dealroadshow/kodegen)
tool. 

This repository does not use semantic versioning, since it must define different
sets of classes for different Kubernetes API versions.

Therefore, in order to install PHP classes for Kubernetes API v1.16.* use `v1.16.*`
release of this library.

This is a low-level library, so in order to get a maximum of functionality and 
convenience for writing your Kubernetes manifests, use [dealroadshow/k8s-framework](https://github.com/dealroadshow/k8s-framework)
or [dealroadshow/k8s-bundle](https://github.com/dealroadshow/k8s-bundle), which integrates 
[dealroadshow/k8s-framework](https://github.com/dealroadshow/k8s-framework) with Symfony 5.
