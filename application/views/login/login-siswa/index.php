<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
    <style>
        /* Molekul Background */
        .background-molecule {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .molecule {
            position: absolute;
            width: 80px;
            height: 80px;
            background: url('<?= base_url('/assets/image/atom.png'); ?>') no-repeat center center / contain;
            animation: float 10s infinite ease-in-out, rotate 8s infinite linear, drift 12s infinite ease-in-out;
            opacity: 0.7;
        }

        /* Animasi Rotasi Molekul (Atom) */
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Animasi Perpindahan Molekul (gerak melayang) */
        /* @keyframes drift {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(20px, -10px) rotate(90deg);
            }
            50% {
                transform: translate(-20px, 20px) rotate(180deg);
            }
            75% {
                transform: translate(10px, -20px) rotate(270deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        } */

        /* Pastikan molekul tidak menutupi konten */
        .content {
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Molecules -->
    <div class="background-molecule">
        <!-- Molekul dengan variasi gerakan -->
        <div class="molecule" style="top: 5%; left: 10%; animation-duration: 8s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 5%; right:10%; animation-duration: 9s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 50%; left: 10%; animation-duration: 7s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 60%; left: 90%; animation-duration: 10s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 80%; left: 20%; animation-duration: 8.5s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 30%; right: 10%; animation-duration: 6s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 40%; left: 60%; animation-duration: 7.5s; animation-delay: 0s;"></div>
        <div class="molecule" style="top: 80%;  animation-duration: 7.5s; animation-delay: 0s;"></div>
    </div>

    <!-- Content (Form Login dan Gambar) -->
    <div class="content flex flex-col sm:flex-row bg-white shadow-xl rounded-xl overflow-hidden max-w-4xl">
        <!-- Bagian kiri - Form login -->
        <div class="flex-1 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Login Siswa</h2>
            <?php if ($this->session->flashdata('error')) : ?>
                <p class="text-red-500 mb-4"><?php echo $this->session->flashdata('error'); ?></p>
            <?php endif; ?>
            <form action="<?= site_url('Login_controller_siswa/proses_login'); ?>" method="post" class="space-y-4">
                <div>
                    <label for="nama" class="block text-gray-600 font-medium">Nama</label>
                    <input type="text" name="nama" id="nama" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                </div>
                <div>
                    <label for="pin" class="block text-gray-600 font-medium">PIN</label>
                    <input type="password" name="pin" id="pin" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                </div>
                <button type="submit" 
                    class="w-full bg-blue-500 text-white py-3 rounded-lg font-medium hover:bg-blue-600 transition">
                    Login
                </button>
            </form>
            <a href="<?= site_url('Login_controller_siswa/kembali'); ?>" 
                class="block text-blue-500 text-center mt-4 font-medium hover:underline">
                Kembali
            </a>
        </div>
        <!-- Bagian kanan - Gambar atau ilustrasi -->
        <div class="hidden sm:flex flex-1 bg-gradient-to-tr from-blue-300 to-blue-500 justify-center items-center">
            <img src="<?= base_url('/assets/image/murid.png'); ?>" alt="Ilustrasi Login" class="w-2/3">
        </div>
    </div>
</body>
</html>
