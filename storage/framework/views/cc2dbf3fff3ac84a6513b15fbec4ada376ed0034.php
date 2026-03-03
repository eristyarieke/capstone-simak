

<?php $__env->startSection('content'); ?>

<h2 class="text-xl font-bold text-gray-800 mb-6">
    <?php echo e($title); ?>

</h2>

<div class="bg-white rounded-lg shadow p-6">

    
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        
        
        <form action="<?php echo e(route('kepsek.users')); ?>" method="GET" class="flex items-center gap-2 w-full md:w-auto">
            <input 
                type="text" 
                name="search" 
                value="<?php echo e(request('search')); ?>"
                placeholder="Cari username atau role..." 
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64"
            >
            
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Cari
            </button>

            <?php if(request('search')): ?>
                <a href="<?php echo e(route('kepsek.users')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm transition">
                    Reset
                </a>
            <?php endif; ?>
        </form>

        
        <a href="<?php echo e(route('kepsek.users.create')); ?>" 
           class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition text-sm">
            + Tambah User
        </a>
    </div>

    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Username</th>
                    <th class="py-3 px-6">Role</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6"><?php echo e($loop->iteration); ?></td>
                        <td class="py-3 px-6 font-medium"><?php echo e($user->username); ?></td>
                        <td class="py-3 px-6">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                <?php echo e(ucfirst($user->role)); ?>

                            </span>
                        </td>
                        <td class="py-3 px-6">
                            <?php if($user->status == 'aktif'): ?>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Aktif
                                </span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Non-Aktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-6 flex gap-3">
                            <a href="<?php echo e(route('kepsek.users.edit', $user->id_user)); ?>" class="text-blue-600 hover:text-blue-800">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="<?php echo e(route('kepsek.users.destroy', $user->id_user)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-delete" class="text-red-600 hover:text-red-800">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400 bg-gray-50">
                            <?php if(request('search')): ?>
                                Tidak ada user ditemukan dengan kata kunci "<strong><?php echo e(request('search')); ?></strong>".
                            <?php else: ?>
                                Data user belum tersedia.
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Capstone\capstone-simak\resources\views/kepsek/users/index.blade.php ENDPATH**/ ?>