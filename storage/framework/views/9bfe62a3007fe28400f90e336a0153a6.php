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
     <?php $__env->slot('header', null, []); ?> Contact Messages <?php $__env->endSlot(); ?>
    <?php if (isset($component)) { $__componentOriginale9af99bfa2d53af14a65b48d2181bd41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.success-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $attributes = $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $component = $__componentOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>

    
    <div class="flex flex-wrap gap-2 mb-5">
        <?php $__currentLoopData = ['all' => 'All', 'unread' => 'Unread', 'read' => 'Read', 'replied' => 'Replied']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.contacts.index', ['status' => $key])); ?>"
           class="px-4 py-1.5 rounded-full text-sm font-medium transition-colors
                  <?php echo e($status === $key ? 'bg-indigo-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-800 dark:hover:text-slate-200'); ?>">
            <?php echo e($label); ?>

            <span class="ml-1 text-xs opacity-75">(<?php echo e($counts[$key]); ?>)</span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
        <div class="divide-y divide-slate-100 dark:divide-slate-700/60">
            <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex flex-col sm:flex-row items-start gap-3 sm:gap-4 px-4 sm:px-5 py-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors <?php echo e($contact->isUnread() ? 'bg-indigo-50/50 dark:bg-indigo-500/5' : ''); ?>">
                
                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm flex-shrink-0">
                    <?php echo e(strtoupper(substr($contact->name, 0, 1))); ?>

                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm"><?php echo e($contact->name); ?></p>
                        <?php if($contact->isUnread()): ?>
                        <span class="text-xs bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 px-2 py-0.5 rounded-full font-medium">Unread</span>
                        <?php elseif($contact->isReplied()): ?>
                        <span class="text-xs bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-2 py-0.5 rounded-full font-medium">Replied</span>
                        <?php else: ?>
                        <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 px-2 py-0.5 rounded-full">Read</span>
                        <?php endif; ?>
                        <p class="text-xs text-slate-400 dark:text-slate-500 ml-auto hidden sm:block"><?php echo e($contact->created_at->diffForHumans()); ?></p>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5"><?php echo e($contact->email); ?> <?php echo e($contact->subject ? '· '.$contact->subject : ''); ?></p>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-1 line-clamp-2"><?php echo e($contact->message); ?></p>
                </div>
                
                <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center mt-2 sm:mt-0">
                    <a href="<?php echo e(route('admin.contacts.show', $contact)); ?>"
                       class="text-xs font-medium bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 px-3 py-1.5 rounded-lg transition-colors">
                        View
                    </a>
                    <form action="<?php echo e(route('admin.contacts.destroy', $contact)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" onclick="return confirm('Delete this message?')"
                                class="text-xs font-medium bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-500/20 px-3 py-1.5 rounded-lg transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="py-16 text-center text-slate-500 dark:text-slate-400">No messages found.</p>
            <?php endif; ?>
        </div>

        <?php if($contacts->hasPages()): ?>
        <div class="p-4 border-t border-slate-200 dark:border-slate-700">
            <?php echo e($contacts->appends(request()->query())->links()); ?>

        </div>
        <?php endif; ?>
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
<?php /**PATH D:\FORTOFOLIO\portfolio-laravel\resources\views/admin/contacts/index.blade.php ENDPATH**/ ?>