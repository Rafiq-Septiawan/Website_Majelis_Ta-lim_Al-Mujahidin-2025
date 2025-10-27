import Swal from "sweetalert2";

let selectedMethod = '';
let totalAmount = 0;

window.goBack = function() {
    window.history.back();
};

function formatRupiah(number) {
    const num = parseInt(number);
    if (isNaN(num) || num === null) {
        return 'Rp 0';
    }
    return 'Rp ' + num.toLocaleString('id-ID');
}

window.copyToClipboard = function(text, name) {
    navigator.clipboard.writeText(text).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Disalin!',
            text: name + ' telah disalin ke clipboard.',
            showConfirmButton: false,
            timer: 1500
        });
    });
};

function getSelectedTagihanDetails() {
    const details = [];
    document.querySelectorAll('input[name="selected_tagihan[]"]:checked').forEach(cb => {
        const bulan = cb.dataset.bulan;
        const tahun = cb.dataset.tahun;
        const nominal = parseInt(cb.dataset.nominal);
        
        details.push({ bulan, tahun, nominal });
    });
    return details;
}

document.addEventListener('DOMContentLoaded', () => {
    if (window.flashMessage) {
        const { type, message } = window.flashMessage;
        
        const icons = {
            success: 'success',
            error: 'error',
            info: 'info'
        };
        
        const titles = {
            success: 'Berhasil!',
            error: 'Gagal!',
            info: 'Perhatian!'
        };
        
        const colors = {
            success: '#14b8a6',
            error: '#dc2626',
            info: '#f59e0b'
        };
        
        Swal.fire({
            icon: icons[type],
            title: titles[type],
            text: message,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: colors[type],
        }).then(() => {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            delete window.flashMessage;
        });
    }
});

window.updateTotal = function() {
    totalAmount = 0;
    const selectedCheckboxes = document.querySelectorAll('input[name="selected_tagihan[]"]:checked');

    selectedCheckboxes.forEach(cb => {
        totalAmount += parseInt(cb.dataset.nominal);
    });

    const totalEl = document.getElementById('totalPembayaran');
    if (totalEl) totalEl.textContent = formatRupiah(totalAmount);

    const nominalInput = document.getElementById('nominal');
    if (nominalInput) nominalInput.value = totalAmount;

    const bulanInput = document.getElementById('bulan');
    if (bulanInput) {
        const firstChecked = selectedCheckboxes[0];
        if (firstChecked && firstChecked.dataset.bulan && firstChecked.dataset.tahun) {
            const bulanFormatted = `${firstChecked.dataset.tahun}-${String(firstChecked.dataset.bulan).padStart(2, '0')}`;
            bulanInput.value = bulanFormatted;
        } else {
            bulanInput.value = '';
        }
    }

    if (typeof selectedMethod !== 'undefined' && selectedMethod !== '') {
        showPaymentDetail(selectedMethod);
    }

    if (typeof checkFormValidity === 'function') {
        checkFormValidity();
    }
};

function checkFormValidity() {
    const selectedCheckboxes = document.querySelectorAll('input[name="selected_tagihan[]"]:checked');
    const selectedCount = selectedCheckboxes.length;
    const btnSubmit = document.getElementById('btnSubmit');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    let isTransferProofValid = true;
    const fileInput = document.getElementById('bukti_transfer'); 
    
    if (selectedMethod !== 'Tunai' && selectedMethod !== '' && selectedCount > 0) {
        if (!fileInput || fileInput.files.length === 0) {
            isTransferProofValid = false;
        }
    }

    const selectedTagihanIdsContainer = document.getElementById('selectedTagihanIdsContainer');
    if (selectedTagihanIdsContainer) {
        selectedTagihanIdsContainer.innerHTML = '';
        if (selectedCount > 0) {
            selectedCheckboxes.forEach(cb => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'tagihan_ids[]'; 
                hiddenInput.value = cb.value;
                selectedTagihanIdsContainer.appendChild(hiddenInput);
            });
        }
    }

    const isMethodSelected = selectedMethod !== '';
    const isValid = selectedCount > 0 && isMethodSelected && isTransferProofValid;
    
    updateStepIndicator(step2, selectedCount > 0);

    if (isValid) {
        btnSubmit.disabled = false;
        btnSubmit.classList.remove('bg-gray-400', 'cursor-not-allowed');
        btnSubmit.classList.add('bg-teal-500', 'hover:bg-teal-600', 'shadow-lg');
        
        updateStepIndicator(step3, true);
    } else {
        btnSubmit.disabled = true;
        btnSubmit.classList.add('bg-gray-400', 'cursor-not-allowed');
        btnSubmit.classList.remove('bg-teal-500', 'hover:bg-teal-600', 'shadow-lg');

        updateStepIndicator(step3, false);
    }
}

function updateStepIndicator(stepElement, isActive) {
    if (!stepElement) return;

    const circle = stepElement.querySelector('div');
    const text = stepElement.querySelector('span');
    
    if (isActive) {
        stepElement.classList.add('active');
        circle.classList.remove('bg-gray-200', 'text-gray-500');
        circle.classList.add('bg-teal-500', 'text-white');
        text.classList.remove('text-gray-500');
        text.classList.add('text-gray-700');
    } else {
        stepElement.classList.remove('active');
        circle.classList.add('bg-gray-200', 'text-gray-500');
        circle.classList.remove('bg-teal-500', 'text-white');
        text.classList.add('text-gray-500');
        text.classList.remove('text-gray-700');
    }
}

window.selectPayment = function(event, method) {
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('active');
        const checkMark = el.querySelector('.check-mark');
        if (checkMark) checkMark.style.display = 'none';
    });

    event.currentTarget.classList.add('active');
    const checkMark = event.currentTarget.querySelector('.check-mark');
    if (checkMark) checkMark.style.display = 'flex';

    selectedMethod = method;
    const metodeBayar = document.getElementById('metode_bayar');
    if (metodeBayar) metodeBayar.value = method;

    const uploadBox = document.getElementById('dropArea');
    const uploadInput = document.getElementById('bukti_transfer');

    if (uploadBox && uploadInput) {
        if (method === 'QRIS' || method === 'Transfer Bank' || method === 'E-Wallet') {
            uploadBox.classList.remove('hidden');
            uploadInput.required = true;
        } else {
            uploadBox.classList.add('hidden');
            uploadInput.required = false;
            uploadInput.value = '';
            document.getElementById('fileNameDisplay').textContent = '';
        }
    }

    showPaymentDetail(method);
    checkFormValidity();
};

function showPaymentDetail(method) {
    const detailDiv = document.getElementById('paymentDetail');
    if (!detailDiv) return;

    detailDiv.classList.remove('hidden');
    let content = '';

    const banks = [
        { name: 'BCA', rekening: '1234567890', an: "Majelis Ta'lim Al-Mujahidin", logo: window.bankAssets?.bca || '/images/Bank/bca.png' },
        { name: 'Mandiri', rekening: '9876543210', an: "Majelis Ta'lim Al-Mujahidin", logo: window.bankAssets?.mandiri || '/images/Bank/mandiri.png' },
        { name: 'BRI', rekening: '5566778899', an: "Majelis Ta'lim Al-Mujahidin", logo: window.bankAssets?.bri || '/images/Bank/bri.png' },
        { name: 'BNI', rekening: '2233445566', an: "Majelis Ta'lim Al-Mujahidin", logo: window.bankAssets?.bni || '/images/Bank/bni.png' },
    ];

    const wallets = [
        { name: 'OVO', nomor: '081234567890', an: "Majelis Ta'lim Al-Mujahidin", logo: window.walletAssets?.ovo || '/images/E-Wallet/ovo.png' },
        { name: 'GoPay', nomor: '085612345678', an: "Majelis Ta'lim Al-Mujahidin", logo: window.walletAssets?.gopay || '/images/E-Wallet/gopay.png' },
        { name: 'DANA', nomor: '082198765432', an: "Majelis Ta'lim Al-Mujahidin", logo: window.walletAssets?.dana || '/images/E-Wallet/dana.png' },
        { name: 'ShopeePay', nomor: '089912345678', an: "Majelis Ta'lim Al-Mujahidin", logo: window.walletAssets?.spay || '/images/E-Wallet/spay.png' },
    ];


    if (method === 'QRIS') {
        content = `
            <div class="detail-card fade-in">
                <h3 class="text-xl font-bold text-teal-600 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                    </svg>
                    Pembayaran via QRIS
                </h3>
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="qr-code-container shrink-0">
                        <img src="${window.qrisImage || '/images/barcode.png'}" alt="QRIS Code" class="w-40 h-40 border border-gray-200 p-1 rounded">
                    </div>
                    <div class="text-sm space-y-3 w-full">
                        <ul class="list-disc ml-5 space-y-2 text-gray-600">
                            <li>Scan QR Code di samping menggunakan aplikasi E-Wallet/Mobile Banking Anda.</li>
                            <li>Pastikan nominal yang dibayar adalah <span class="font-bold text-teal-600">${formatRupiah(totalAmount)}</span></li>
                            <li>Upload bukti transfer di bawah ini setelah berhasil.</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="bukti_transfer" class="block font-semibold text-gray-800 mb-2">Upload Bukti Pembayaran (Wajib)</label>
                    <div class="upload-area p-6 text-center rounded-lg cursor-pointer border-2 border-dashed border-gray-300 hover:border-teal-500 transition" id="dropArea">
                        <input type="file" name="bukti_transfer" id="bukti_transfer" class="hidden" accept="image/*" onchange="window.handleFileSelect(event);">
                        <p class="text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg> Seret & lepas gambar di sini, atau <span class="text-teal-600 font-semibold">klik untuk memilih file</span>.</p>
                        <p id="fileNameDisplay" class="mt-2 text-sm text-gray-600 italic"></p>
                    </div>
                </div>
            </div>`;
    }

    else if (method === 'Transfer Bank') {
        const bankCards = banks.map(b => `
            <div class="p-4 bg-white rounded-lg border flex justify-between items-center shadow-sm hover:border-teal-400 transition cursor-pointer"
                onclick="copyToClipboard('${b.rekening}', 'Nomor Rekening ${b.name}')">
                <div>
                    <p class="text-sm text-gray-500 font-semibold">${b.name}</p>
                    <p class="text-xs text-gray-500 mb-1">A.N: <span class="font-semibold text-gray-700">${b.an}</span></p>
                    <p class="text-lg font-bold text-teal-600 tracking-wide">${b.rekening}</p>
                </div>
                <img src="${b.logo}" alt="${b.name}" class="w-14 h-auto">
            </div>
        `).join('');

        content = `
            <div class="detail-card fade-in">
                <h3 class="text-xl font-bold text-teal-600 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Pembayaran via Transfer Bank
                </h3>
                <p class="text-gray-700 mb-4 text-sm">Silakan pilih salah satu bank di bawah ini untuk melakukan transfer pembayaran sejumlah <span class="font-bold text-teal-600">${formatRupiah(totalAmount)}</span>:</p>
                <div class="space-y-3">${bankCards}</div>

                <div class="mt-6">
                    <label for="bukti_transfer" class="block font-semibold text-gray-800 mb-2">Upload Bukti Pembayaran (Wajib)</label>
                    <div class="upload-area p-6 text-center rounded-lg cursor-pointer border-2 border-dashed border-gray-300 hover:border-teal-500 transition" id="dropArea">
                        <input type="file" name="bukti_transfer" id="bukti_transfer" class="hidden" accept="image/*" onchange="window.handleFileSelect(event);">
                        <p class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg> 
                            Seret & lepas gambar di sini, atau 
                            <span class="text-teal-600 font-semibold">klik untuk memilih file</span>.
                        </p>
                        <p id="fileNameDisplay" class="mt-2 text-sm text-gray-600 italic"></p>
                    </div>
                </div>
            </div>`;
    }

    else if (method === 'E-Wallet') {
        const walletCards = wallets.map(w => `
            <div class="p-4 bg-white rounded-lg border flex justify-between items-center shadow-sm hover:border-teal-400 transition cursor-pointer"
                onclick="copyToClipboard('${w.nomor}', '${w.name}')">
                <div>
                    <p class="text-sm text-gray-500 font-semibold">${w.name}</p>
                    <p class="text-xs text-gray-500 mb-1">A.N: <span class="font-semibold text-gray-700">${w.an}</span></p>
                    <p class="text-lg font-bold text-teal-600 tracking-wide">${w.nomor}</p>
                </div>
                <img src="${w.logo}" alt="${w.name}" class="w-14 h-auto">
            </div>`).join('');

        content = `
            <div class="detail-card fade-in">
                <h3 class="text-xl font-bold text-teal-600 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                </svg>
                Pembayaran via E-Wallet</h3>
                <p class="text-gray-700 mb-4 text-sm">Gunakan salah satu e-wallet berikut untuk transfer ke nomor di bawah sejumlah <span class="font-bold text-teal-600">${formatRupiah(totalAmount)}</span>:</p>
                <div class="space-y-3">${walletCards}</div>

                <div class="mt-6">
                    <label for="bukti_transfer" class="block font-semibold text-gray-800 mb-2">Upload Bukti Pembayaran (Wajib)</label>
                    <div class="upload-area p-6 text-center rounded-lg cursor-pointer border-2 border-dashed border-gray-300 hover:border-teal-500 transition" id="dropArea">
                        <input type="file" name="bukti_transfer" id="bukti_transfer" class="hidden" accept="image/*" onchange="window.handleFileSelect(event);">
                        <p class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg> 
                            Seret & lepas gambar di sini, atau 
                            <span class="text-teal-600 font-semibold">klik untuk memilih file</span>.
                        </p>
                        <p id="fileNameDisplay" class="mt-2 text-sm text-gray-600 italic"></p>
                    </div>
                </div>
            </div>`;
    }

    else if (method === 'Tunai') {
        content = `
            <div class="detail-card fade-in bg-yellow-50 border-yellow-300 p-6 rounded-lg shadow-inner">
                <h3 class="text-xl font-bold text-yellow-700 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                Pembayaran Tunai</h3>
                <p class="text-2xl font-bold text-orange-600">${formatRupiah(totalAmount)}</p>
                <ul class="list-disc ml-5 mt-3 text-sm text-gray-700 space-y-1">
                    <li>Siapkan uang tunai sesuai nominal di atas.</li>
                    <li>Tekan tombol konfirmasi di bawah.</li>
                    <li>Bayar langsung ke kasir Majelis.</li>
                </ul>
            </div>`;
    }

    detailDiv.innerHTML = content;
    initializeDropAreaListeners();
}

function initializeDropAreaListeners() {
    const dropArea = document.getElementById('dropArea'); 
    if (!dropArea) return;

    const fileInput = document.getElementById('bukti_transfer');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    dropArea.removeEventListener('click', () => fileInput && fileInput.click());
    dropArea.removeEventListener('dragover', handleDragOver);
    dropArea.removeEventListener('dragleave', handleDragLeave);
    dropArea.removeEventListener('drop', handleDrop);
    dropArea.addEventListener('click', () => fileInput && fileInput.click());
    dropArea.addEventListener('dragover', handleDragOver);
    dropArea.addEventListener('dragleave', handleDragLeave);
    dropArea.addEventListener('drop', handleDrop);
}

const handleDragOver = (e) => {
    e.preventDefault();
    document.getElementById('dropArea').classList.add('border-teal-500', 'bg-teal-50/50');
};

const handleDragLeave = () => {
    document.getElementById('dropArea').classList.remove('border-teal-500', 'bg-teal-50/50');
};

const handleDrop = (e) => {
    e.preventDefault();
    document.getElementById('dropArea').classList.remove('border-teal-500', 'bg-teal-50/50');
    const fileInput = document.getElementById('bukti_transfer');
    if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        handleFileSelect({ target: fileInput });
        checkFormValidity();
    }
};

window.handleFileSelect = function(event) {
    const fileInput = event.target;
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    
    if (!fileInput || !fileInput.files.length) {
        if (fileNameDisplay) fileNameDisplay.innerHTML = '';
        checkFormValidity();
        return;
    }

    const file = fileInput.files[0];
    const fileName = file.name;

    if (!file.type.startsWith('image/')) {
        fileNameDisplay.innerHTML = `<span class="text-red-500 text-sm">File bukan gambar!</span>`;
        fileInput.value = '';
        checkFormValidity();
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        fileNameDisplay.innerHTML = `
            <div class="mt-3 flex flex-col items-center">
                <img src="${e.target.result}" alt="Preview" class="w-40 h-40 object-contain rounded-lg shadow-md border p-1">
                <p class="text-gray-600 mt-2 text-sm italic">File terpilih: ${fileName}</p>
                <button type="button" id="removeImageBtn" 
                    class="mt-2 px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Hapus
                </button>
            </div>
        `;

        const removeBtn = document.getElementById('removeImageBtn');
        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                fileInput.value = '';
                fileNameDisplay.innerHTML = '';
                checkFormValidity();
            });
        }
    };

    reader.readAsDataURL(file);
    checkFormValidity();
};

window.confirmPayment = function(event) {
    event.preventDefault();

    checkFormValidity(); 
    const btnSubmit = document.getElementById('btnSubmit');
    if (btnSubmit.disabled) {
        Swal.fire('Perhatian', 'Harap lengkapi semua isian (pilih tagihan, metode, dan upload bukti jika perlu).', 'warning');
        return;
    }

    const selectedTagihan = getSelectedTagihanDetails();
    const metodeBayar = selectedMethod;
    const total = formatRupiah(totalAmount);

    let tagihanListHTML = selectedTagihan.map(item => 
        `<li>${item.bulan} ${item.tahun} (${formatRupiah(item.nominal)})</li>`
    ).join('');

    const isTransferMethod = (metodeBayar !== 'Tunai');
    
    let statusText ='';
        
    let buktiTransferFile = '';
    const fileInput = document.getElementById('bukti_transfer');
    if (isTransferMethod && fileInput && fileInput.files.length > 0) {
        buktiTransferFile = `<p class="text-sm font-medium mt-3">Bukti Transfer: <span class="text-teal-600">${fileInput.files[0].name}</span></p>`;
    } 

    Swal.fire({
        title: 'Konfirmasi Pembayaran',
        html: `
            <div class="text-left space-y-3 p-4">
                <p class="text-lg font-bold text-gray-700">Total Pembayaran:</p>
                <p class="text-3xl font-extrabold text-teal-600">${total}</p>
                
                <p class="text-lg font-semibold text-gray-700 mt-4">Metode:</p>
                <p class="text-xl font-bold text-orange-500">${metodeBayar}</p>
                
                ${buktiTransferFile}
                ${statusText}
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00B894',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Bayar Sekarang!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('pembayaranForm');
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text || 'Gagal mengirim pembayaran!');
                        });
                    }
                    return response.text();
                })
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pembayaran berhasil dilakukan.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = '/santri/pembayaran';
                    });
                })
                .catch(err => {
                    console.error('Error detail:', err);
                    Swal.fire('Gagal', err.message || 'Terjadi kesalahan saat memproses pembayaran', 'error');
                });
            }
    });
};

document.addEventListener('DOMContentLoaded', () => {
    updateTotal();
    const oldMethod = document.getElementById('metode_bayar')?.value;
    if (oldMethod) {
        const methodDiv = document.querySelector(`.payment-method[onclick*="'${oldMethod}'"]`);
        if (methodDiv) {
            const mockEvent = { currentTarget: methodDiv };
            selectPayment(mockEvent, oldMethod);
        }
    }

    const form = document.getElementById('pembayaranForm'); 
    const btnSubmit = document.getElementById('btnSubmit');

    if (form && btnSubmit) {
        btnSubmit.removeEventListener('click', confirmPayment);

        btnSubmit.addEventListener('click', (e) => {
            confirmPayment(e);
        });
    }

    initializeDropAreaListeners();
});