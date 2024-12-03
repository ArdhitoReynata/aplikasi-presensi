<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor">
    <section id="app" class="bg-bgcolor flex">
        <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
        <sidebar2></sidebar2>
        <div class="ml-[68px] lg:ml-64 mt-16 w-full font-inter p-5">
            <div class="grid grid-cols-6 border bg-white border-strcolor rounded-md w-full content-center gap-5">
                <div class="grid col-span-2 py-5 items-end justify-items-end">
                    <button class="font-semibold bg-opacity-50 bg-btncolor text-white h-auto rounded-full hover:bg-btncolor transition-all duration-300 transform hover:scale-105 text-15 absolute mx-7 mb-2 p-4" onclick="triggerFileInput()">
                        <img src="/images/pen-white.svg" alt="Edit Profile Picture">
                    </button>
                    <img id="profileImage"
                        src="{{ asset($user->profile_image ? 'storage/' . $user->profile_image : 'images/default-profile.jpg') }}"
                        alt="Profile Image"
                        class="rounded-md w-[354px] h-[472px] object-cover mx-5">
                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*" class="hidden" onchange="previewImageAndUpload(event)">
                </div>
                <div class="grid col-span-4 grid-rows-auto font-bold py-5 pr-5 gap-5">
                    <div class="grid grid-cols-4 row-span-3 border border-strcolor rounded-md p-4 text-14">
                        <div class="col-span-4 text-18">
                            <p>Data Personal</p>
                        </div>
                        <div class="col-span-2">
                            <p>Nama :</p>
                            <p class="font-medium">{{ $user->nama }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>NIK :</p>
                            <p class="font-medium">{{ $user->nik }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Nomor Telepon :</p>
                            <p class="font-medium">{{ $user->telepon }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Email :</p>
                            <p class="font-medium">{{ $user->email }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Alamat :</p>
                            <p class="font-medium">{{ $user->alamat }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Jenis Kelamin :</p>
                            <p class="font-medium">{{ $user->jk }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 row-span-3 border border-strcolor rounded-md p-4 text-14">
                        <p class="col-span-4 text-18">Data Perusahaan</p>
                        <div class="col-span-2">
                            <p>NIP :</p>
                            <p class="font-medium">{{ $user->nip }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Role di Aplikasi :</p>
                            <p class="font-medium">{{ $user->role }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Divisi :</p>
                            <p class="font-medium">{{ $user->divisi }}</p>
                        </div>
                        <div class="col-span-2">
                            <p>Bagian :</p>
                            <p class="font-medium">{{ $user->bagian }}</p>
                        </div>
                    </div>
                    <div class="grid row-span-1 h-full gap-5">
                        <!-- Tombol untuk membuka modal -->
                        <button
                            class="font-semibold bg-dangercolor text-white w-full h-auto rounded-md hover:bg-dangercolor2 transition-all duration-300 transform hover:scale-100 text-15"
                            onclick="openPasswordModal()">
                            Ubah Password
                        </button>
                    </div>

                    <!-- Modal untuk mengubah password -->
                    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
                        <div class="bg-white rounded-md w-96">
                            <div class="bg-btncolor rounded-t-md p-4">
                                <h2 class="text-16 font-bold text-white">Ubah Password</h2>
                            </div>
                            <!-- Form untuk mengubah password -->
                            <form id="passwordForm" action="{{ route('profile.updatePassword') }}" method="POST" class="p-5">
                                @csrf
                                <div class="mb-3">
                                    <label for="current_password" class="block text-sm">Password Lama</label>
                                    <input type="password" id="current_password" name="current_password" class="w-full border rounded p-2 mt-1" required>
                                    @error('current_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="block text-sm">Password Baru</label>
                                    <input type="password" id="new_password" name="new_password" class="w-full border rounded p-2 mt-1" required>
                                    @error('new_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="block text-sm">Konfirmasi Password Baru</label>
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full border rounded p-2 mt-1" required>
                                    @error('new_password_confirmation')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-between">
                                    <button type="submit" class="bg-btncolor text-white rounded px-4 py-2">Simpan Perubahan</button>
                                    <button type="button" onclick="closePasswordModal()" class="bg-gray-300 text-black rounded px-4 py-2">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        // Fungsi untuk membuka modal
        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            openPasswordModal();
        });
        // Fungsi untuk menutup modal
        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }
        // Fungsi untuk memicu input file ketika ikon ditekan
        function triggerFileInput() {
            document.getElementById('profileImageInput').click();
        }

        // Fungsi untuk menampilkan preview gambar dan mengirimnya ke server
        function previewImageAndUpload(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                // Update gambar di frontend
                document.getElementById('profileImage').src = e.target.result;
            };

            // Membaca file sebagai Data URL untuk preview
            if (file) {
                reader.readAsDataURL(file);

                // Mengirim gambar ke server menggunakan AJAX
                const formData = new FormData();
                formData.append('profile_image', file);
                formData.append('_token', '{{ csrf_token() }}'); // Token CSRF untuk keamanan

                fetch('{{ route("profile.updateImage") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Gambar berhasil diperbarui");
                        } else {
                            console.error("Gambar gagal diperbarui");
                        }
                    })
                    .catch(error => {
                        console.error("Terjadi kesalahan:", error);
                    });
            }
        }
    </script>
</body>

</html>