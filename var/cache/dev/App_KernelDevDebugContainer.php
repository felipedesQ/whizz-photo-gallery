<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerUpxxJ1z\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerUpxxJ1z/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerUpxxJ1z.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerUpxxJ1z\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerUpxxJ1z\App_KernelDevDebugContainer([
    'container.build_hash' => 'UpxxJ1z',
    'container.build_id' => '77219319',
    'container.build_time' => 1625623484,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerUpxxJ1z');
