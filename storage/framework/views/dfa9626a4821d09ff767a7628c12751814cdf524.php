

<?php $__env->startSection('title', 'Prestasi Sekolah'); ?>

<?php $__env->startSection('content'); ?>


<section class="bg-slate-50 py-20 border-b border-slate-200">
    <div class="container mx-auto px-4 text-center">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">Hall of Fame</span>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 animate-fade-in-up delay-100">
            Prestasi Siswa & Sekolah
        </h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto animate-fade-in-up delay-200">
            Bukti nyata dedikasi, kerja keras, dan kualitas pendidikan dalam mencetak generasi juara.
        </p>
    </div>
</section>


<section class="py-20 bg-white relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-10 left-10 w-32 h-32 bg-yellow-100 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $prestasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="relative bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col h-full">
                    
                    
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-yellow-400 to-yellow-200 rounded-t-2xl z-20"></div>

                    
                    <?php if($p->tahun): ?>
                        <div class="absolute top-4 right-4 z-30">
                            <span class="bg-white/90 backdrop-blur-sm text-slate-600 text-xs font-bold px-3 py-1 rounded-full border border-slate-200 shadow-sm">
                                <?php echo e($p->tahun); ?>

                            </span>
                        </div>
                    <?php endif; ?>

                    
                    <div class="mb-5 relative">
                        <?php if($p->foto): ?>
                            
                            <div class="w-full h-48 rounded-xl overflow-hidden relative shadow-inner bg-slate-100 group-hover:shadow-md transition-all">
                                
                                <img src="<?php echo e(asset('storage/' . $p->foto)); ?>" 
                                     alt="<?php echo e($p->judul); ?>" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        <?php else: ?>
                            
                            <div class="w-full h-48 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center relative overflow-hidden group-hover:bg-yellow-50/50 transition-colors">
                                <div class="absolute inset-0 bg-yellow-400 blur-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                                <div class="w-20 h-20 rounded-full bg-white border border-yellow-100 flex items-center justify-center shadow-sm relative z-10">
                                    <i class="fas fa-trophy text-4xl text-yellow-500 drop-shadow-sm transform group-hover:scale-110 transition-transform duration-300"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    

                    
                    <div class="mb-3">
                        <?php if($p->juara_ke || $p->tingkat): ?>
                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wide border border-blue-100">
                                <i class="fa-solid fa-medal text-blue-500"></i>
                                <?php echo e($p->juara_ke ?? 'Juara'); ?> <?php echo e($p->tingkat ? '• ' . $p->tingkat : ''); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    
                    <h3 class="text-xl font-bold text-slate-800 mb-2 leading-snug group-hover:text-blue-600 transition-colors line-clamp-2">
                        <?php echo e($p->judul ?? $p->nama_lomba ?? 'Prestasi Sekolah'); ?>

                    </h3>

                    
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                        <?php echo e($p->deskripsi ?? 'Prestasi membanggakan yang diraih melalui kompetisi dan kerja keras.'); ?>

                    </p>

                    
                    <?php if(!empty($p->nama_siswa)): ?>
                        <div class="mt-auto pt-4 border-t border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <i class="fa-solid fa-user text-xs"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mb-0.5">Diraih Oleh</p>
                                <p class="text-sm font-semibold text-slate-700 truncate">
                                    <?php echo e($p->nama_siswa); ?>

                                </p>
                            </div>
                        </div>
                    <?php else: ?>
                         <div class="mt-auto"></div>
                    <?php endif; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                
                <div class="col-span-full py-24 text-center">
                    <div class="inline-block p-6 rounded-full bg-slate-50 mb-4 border border-slate-100">
                        <i class="fas fa-award text-5xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-600">Belum Ada Data Prestasi</h3>
                    <p class="text-slate-400 text-sm mt-1">Data prestasi akan segera diupdate.</p>
                </div>
            <?php endif; ?>
        </div>

        
        <?php if($prestasi->hasPages()): ?>
            <div class="mt-16 flex justify-center">
                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                    <?php echo e($prestasi->links('pagination::tailwind')); ?>

                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Capstone\capstone-simak\resources\views/frontend/prestasi.blade.php ENDPATH**/ ?>