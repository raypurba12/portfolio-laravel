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
     <?php $__env->slot('header', null, []); ?> Education <?php $__env->endSlot(); ?>
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
    <div class="flex justify-end mb-4">
        <a href="<?php echo e(route('admin.education.create')); ?>" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">+ Add Education</a>
    </div>
    <?php if (isset($component)) { $__componentOriginal4658ca741dca2689097dd49737f7416c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4658ca741dca2689097dd49737f7416c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-gray-700 text-gray-400 text-xs uppercase tracking-wider">
                    <th class="pb-3 text-left">Institution</th>
                    <th class="pb-3 text-left">Degree / Field</th>
                    <th class="pb-3 text-left">Period</th>
                    <th class="pb-3 text-right">Actions</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-700/50">
                    <?php $__empty_1 = true; $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-700/30 transition-colors">
                        <td class="py-3">
                            <div class="flex items-center gap-3">
                                <?php if($edu->logo_path): ?>
                                <img src="<?php echo e(asset('storage/' . str_replace('public/', '', $edu->logo_path))); ?>" class="w-8 h-8 rounded object-contain bg-gray-700 p-1">
                                <?php else: ?>
                                <div class="w-8 h-8 rounded bg-blue-500/20 flex items-center justify-center text-blue-400 text-xs font-bold"><?php echo e(substr($edu->institution,0,2)); ?></div>
                                <?php endif; ?>
                                <p class="font-medium text-white"><?php echo e($edu->institution); ?></p>
                            </div>
                        </td>
                        <td class="py-3 text-gray-300"><?php echo e($edu->degree); ?> <?php echo e($edu->field_of_study ? '— '.$edu->field_of_study : ''); ?></td>
                        <td class="py-3 text-gray-400"><?php echo e($edu->start_year); ?> — <?php echo e($edu->is_current ? 'Present' : ($edu->end_year ?? '-')); ?></td>
                        <td class="py-3 text-right">
                            <a href="<?php echo e(route('admin.education.edit', $edu)); ?>" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                            <form action="<?php echo e(route('admin.education.destroy', $edu)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="py-10 text-center text-gray-500">No education added yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4658ca741dca2689097dd49737f7416c)): ?>
<?php $attributes = $__attributesOriginal4658ca741dca2689097dd49737f7416c; ?>
<?php unset($__attributesOriginal4658ca741dca2689097dd49737f7416c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4658ca741dca2689097dd49737f7416c)): ?>
<?php $component = $__componentOriginal4658ca741dca2689097dd49737f7416c; ?>
<?php unset($__componentOriginal4658ca741dca2689097dd49737f7416c); ?>
<?php endif; ?>
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
<?php /**PATH D:\FORTOFOLIO\portfolio-laravel\resources\views/admin/education/index.blade.php ENDPATH**/ ?>