<?php if(session('success')): ?>
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 dark:border-emerald-900/50 bg-emerald-50 dark:bg-emerald-950/50 px-4 py-3 text-sm font-medium text-emerald-700 dark:text-emerald-300 shadow-sm">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
<?php /**PATH D:\FORTOFOLIO\portfolio-laravel\resources\views/components/success-alert.blade.php ENDPATH**/ ?>