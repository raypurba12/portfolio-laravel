<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> Dashboard <?php $__env->endSlot(); ?>

    
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3 sm:gap-4 mb-8">
        <?php
        $cards = [
            ['label' => 'Projects',     'value' => $stats['projects'],     'color' => 'purple', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            ['label' => 'Skills',       'value' => $stats['skills'],       'color' => 'blue',   'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
            ['label' => 'Certificates', 'value' => $stats['certificates'], 'color' => 'green',  'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ['label' => 'Services',     'value' => $stats['services'],     'color' => 'yellow', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Messages',     'value' => $stats['contacts'],     'color' => 'pink',   'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ['label' => 'Unread',       'value' => $stats['unread'],       'color' => 'red',    'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
        ];
        $colorMap = [
            'purple' => 'bg-purple-100 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-200 dark:border-purple-500/20',
            'blue'   => 'bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-500/20',
            'green'  => 'bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 border-green-200 dark:border-green-500/20',
            'yellow' => 'bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border-yellow-200 dark:border-yellow-500/20',
            'pink'   => 'bg-pink-100 dark:bg-pink-500/10 text-pink-600 dark:text-pink-400 border-pink-200 dark:border-pink-500/20',
            'red'    => 'bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 border-red-200 dark:border-red-500/20',
        ];
        ?>

        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-4 sm:p-5 flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl border flex items-center justify-center flex-shrink-0 <?php echo e($colorMap[$card['color']]); ?>">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($card['icon']); ?>"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($card['value']); ?></p>
                <p class="text-xs text-slate-500 dark:text-slate-400 truncate"><?php echo e($card['label']); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
            <div class="px-4 sm:px-5 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h3 class="font-semibold text-slate-900 dark:text-white">Recent Messages</h3>
                <a href="<?php echo e(route('admin.contacts.index')); ?>" class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium">View all →</a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-700/60">
                <?php $__empty_1 = true; $__currentLoopData = $recentContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('admin.contacts.show', $contact)); ?>"
                   class="flex items-start gap-3 px-4 sm:px-5 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm flex-shrink-0 mt-0.5">
                        <?php echo e(strtoupper(substr($contact->name, 0, 1))); ?>

                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-100 truncate"><?php echo e($contact->name); ?></p>
                            <?php if($contact->isUnread()): ?>
                            <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0"></span>
                            <?php endif; ?>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate"><?php echo e($contact->subject ?? $contact->message); ?></p>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500 flex-shrink-0 hidden sm:block"><?php echo e($contact->created_at->diffForHumans()); ?></p>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="px-5 py-8 text-center text-sm text-slate-500 dark:text-slate-400">No messages yet.</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
            <div class="px-4 sm:px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                <h3 class="font-semibold text-slate-900 dark:text-white">Quick Actions</h3>
            </div>
            <div class="grid grid-cols-2 gap-px bg-slate-200 dark:bg-slate-700">
                <?php
                $quickLinks = [
                    ['label' => 'Add Project',     'href' => route('admin.projects.create'),     'color' => 'text-indigo-600 dark:text-indigo-400'],
                    ['label' => 'Add Skill',        'href' => route('admin.skills.create'),       'color' => 'text-blue-600 dark:text-blue-400'],
                    ['label' => 'Add Experience',   'href' => route('admin.experience.create'),   'color' => 'text-emerald-600 dark:text-emerald-400'],
                    ['label' => 'Add Certificate',  'href' => route('admin.certificates.create'), 'color' => 'text-amber-600 dark:text-yellow-400'],
                    ['label' => 'Add Service',      'href' => route('admin.services.create'),     'color' => 'text-pink-600 dark:text-pink-400'],
                    ['label' => 'Site Settings',    'href' => route('admin.settings.index'),      'color' => 'text-cyan-600 dark:text-cyan-400'],
                ];
                ?>
                <?php $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link['href']); ?>"
                   class="bg-white dark:bg-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-700/50 p-3 sm:p-4 flex items-center gap-2 transition-colors">
                    <span class="text-base sm:text-lg text-slate-300 dark:text-slate-600">→</span>
                    <span class="text-xs sm:text-sm font-medium <?php echo e($link['color']); ?>"><?php echo e($link['label']); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php /**PATH D:\FORTOFOLIO\portfolio-laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>