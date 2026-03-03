<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo e($title ?? 'SIMAK'); ?></title>
  <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    <?php if(auth()->guard()->check()): ?>
        <?php $role = auth()->user()->role; ?>

        <?php if($role === 'admin'): ?>
            <?php echo $__env->make('layouts.sidebar-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif($role === 'guru'): ?>
            <?php echo $__env->make('layouts.sidebar-guru', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif($role === 'kepsek'): ?>
            <?php echo $__env->make('layouts.sidebar-kepsek', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    <!-- APP WRAPPER -->
    <div id="app-wrapper" class="app-wrapper min-h-screen flex flex-col">

        <!-- HEADER -->
        <header class="bg-white border-b px-6 py-4 flex items-center gap-4">
            <button id="toggleSidebar"
                    class="text-gray-600 hover:text-gray-900">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1 class="text-sm font-semibold text-gray-700">
                Sistem Informasi Manajemen Sekolah dan Akademik (SIMAK)
            </h1>
        </header>

        <main class="flex-1 px-8 py-6">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script>

    window.flashSuccess = "<?php echo e(session('success')); ?>";
    window.flashError   = "<?php echo e(session('error')); ?>";
</script>

<script src="<?php echo e(asset('js/notif.js')); ?>"></script>

</body>

</html><?php /**PATH D:\Capstone\capstone-simak\resources\views/layouts/app.blade.php ENDPATH**/ ?>