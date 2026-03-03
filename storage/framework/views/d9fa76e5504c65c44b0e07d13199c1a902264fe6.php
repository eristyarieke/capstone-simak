<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title'); ?> - SDN Kendangsari III</title>

    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/public.css')); ?>?v=<?php echo e(time()); ?>">

    
    <style>
        /* Memaksa Container ke Tengah & Punya Jarak Kiri-Kanan */
        .custom-container {
            width: 100%;
            max-width: 1280px !important; /* Lebar maksimal website */
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
        }

        /* Style Garis Bawah Navbar */
        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #2563EB;
            transition: width .3s;
            margin-top: 2px;
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        /* Responsif HP: Jarak lebih kecil */
        @media (max-width: 640px) {
            .custom-container {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
        }
    </style>
</head>

<body class="background-color: red !important bg-slate-50 text-slate-700 flex flex-col min-h-screen font-poppins selection:bg-blue-200 selection:text-blue-900">


<nav class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200/60 shadow-sm h-20">
    
    
    <div class="custom-container h-full flex items-center justify-between">

        
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 group">
            <img src="<?php echo e(asset('images/logosekolah.png')); ?>" class="w-12 h-12 transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
            <div class="leading-tight">
                <h1 class="font-bold text-lg text-slate-800 tracking-tight group-hover:text-blue-700 transition-colors">SDN Kendangsari III</h1>
                <p class="text-xs text-slate-500 font-medium">Surabaya - Jawa Timur</p>
            </div>
        </a>

        
        <?php
            $menu = [
                'home'     => 'Beranda',
                'profil'   => 'Profil',
                'kegiatan' => 'Kegiatan',
                'prestasi' => 'Prestasi',
                'artikel'  => 'Artikel',
                'kontak'   => 'Kontak',
            ];
        ?>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route($route)); ?>"
                   class="nav-link relative py-1 transition-colors duration-300
                   <?php echo e(request()->routeIs($route) ? 'text-blue-700 font-semibold active' : 'text-slate-600 hover:text-blue-600'); ?>">
                    <?php echo e($label); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</nav>


<main class="flex-grow pt-20">

    
    <?php echo $__env->yieldContent('hero'); ?>

    
    
    <section class="custom-container my-12">
        <?php echo $__env->yieldContent('content'); ?>
    </section>

</main>


<footer class="bg-slate-900 text-slate-300 border-t-4 border-blue-600">

    
    <div class="custom-container py-12 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6">

        
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <div class="bg-white/10 p-2 rounded-full backdrop-blur-sm">
                    <img src="<?php echo e(asset('images/logosekolah.png')); ?>" class="w-14 h-14">
                </div>
                <div>
                    <h3 class="font-bold text-xl text-white">SDN Kendangsari III/278</h3>
                    <p class="text-xs text-slate-400">Bertaqwa, Berilmu, Berkarakter Mulia Dan Berwawasan Lingkungan</p>
                </div>
            </div>

            <p class="text-sm text-slate-400 leading-relaxed pr-4">
                Jl. Raya Tenggilis Mejoyo No. 3, Kali Rungkut, Kec. Rungkut, <br>
                Kota Surabaya, Jawa Timur 60293
            </p>
        </div>

        
        <div class="md:pl-2">
            <h3 class="font-bold text-lg text-white mb-6 relative inline-block">
                Menu Utama
                <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-blue-500 rounded-full"></span>
            </h3>
            <ul class="space-y-3 text-sm">
                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route($route)); ?>" class="hover:text-blue-400 hover:pl-2 transition-all duration-300 flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-blue-600"></i> <?php echo e($label); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        
        <div class="md:pl-6">
            <h3 class="font-bold text-lg text-white mb-6 relative inline-block">
                Hubungi Kami
                <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-blue-500 rounded-full"></span>
            </h3>
            <ul class="space-y-4 text-sm text-slate-400">
                
                
                <li>
                    <a href="https://www.instagram.com/sdn_kendangsari3_official/" target="_blank" rel="noopener noreferrer" class="flex gap-4 items-center group">
                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <span class="group-hover:text-white transition-colors">@sdn_kendangsari3_official</span>
                    </a>
                </li>

                
                <li>
                    <a href="https://www.youtube.com/@sdnkendangsariiii2787" target="_blank" rel="noopener noreferrer" class="flex gap-4 items-center group">
                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-brands fa-youtube"></i>
                        </div>
                        <span class="group-hover:text-white transition-colors">@sdnkendangsariiii2787</span>
                    </a>
                </li>

                
                <li>
                    <a href="<?php echo e(url('/')); ?>" class="flex gap-4 items-center group">
                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <span class="group-hover:text-white transition-colors">www.sdnkendangsari.sch.id</span>
                    </a>
                </li>

                
                <li>
                    <a href="<?php echo e(url('/')); ?>" class="flex gap-4 items-center group">
                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <span class="group-hover:text-white transition-colors">(031) 8411915</span>
                    </a>
                </li>

                
                <li>
                    <a href="<?php echo e(url('/')); ?>" class="flex gap-4 items-center group">
                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span class="group-hover:text-white transition-colors">sdnkensaga@gmail.com</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    
    <div class="bg-slate-950 py-6">
        <div class="custom-container text-center text-xs text-slate-500">
            &copy; <?php echo e(date('Y')); ?> SDN Kendangsari III — <span class="text-slate-400">Capstone Project</span>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper', {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        effect: 'fade',
        fadeEffect: { crossFade: true },
        speed: 1000,
    });

    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('shadow-md', 'bg-white/95');
            nav.classList.remove('bg-white/80', 'shadow-sm');
        } else {
            nav.classList.remove('shadow-md', 'bg-white/95');
            nav.classList.add('bg-white/80', 'shadow-sm');
        }
    });
</script>

</body>
</html><?php /**PATH D:\Capstone\capstone-simak\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>