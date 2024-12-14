<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
	<link rel="icon" href="<?= base_url('/assets/image/logo.png'); ?>" type="image/x-icon">

	<title>Login Guru</title>
</head>

<body class="bg-gradient-to-tr from-cyan-400 to-gray-300">
	<div class="h-screen w-full flex items-center justify-center relative">

		<div class="content flex flex-col sm:flex-row bg-white shadow-xl rounded-xl overflow-hidden max-w-4xl w-full">

			<!-- Left Section -->
			<div class="flex-1 p-12 flex flex-col justify-center sm:w-1/2">
				<h2 class="text-4xl font-bold text-gray-800 mb-8 text-center">Login Guru</h2>

				<?php if ($this->session->flashdata('error')) : ?>
					<p class="text-red-500 mb-6 text-center">
						<?php echo $this->session->flashdata('error'); ?>
					</p>
				<?php endif; ?>

				<form action="<?= site_url('Login_controller_guru/proses_login'); ?>" method="post" class="space-y-4">
					<!-- Nama Field -->
					<label for="nama" class="block text-gray-800 font-medium">Nama:</label>
					<input
						type="text"
						name="nama"
						id="nama"
						required
						class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

					<!-- PIN Field -->
					<label for="pin" class="block text-gray-800 font-medium">PIN:</label>
					<input
						type="password"
						name="pin"
						id="pin"
						required
						class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

					<!-- Submit Button -->
					<button
						type="submit"
						class="w-full font-medium py-4 bg-green-400 text-white rounded-lg hover:bg-green-600 transition">
						Login
					</button>
				</form>

				<!-- Back Link -->
				<a href="<?= site_url('Login_controller_guru/kembali'); ?>" class="text-center mt-6 text-blue-500 hover:underline block">
					Kembali
				</a>
			</div>

			<!-- Right Section -->
			<div class="hidden sm:flex justify-center items-center bg-green-300 sm:w-1/2">
				<img src="<?= base_url('/assets/image/icon-guru.png'); ?>" alt="Guru Icon" class="w-80 h-auto object-contain">
			</div>

		</div>
	</div>
</body>

</html>
