import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

// --- Logika Toast Notification ---

document.addEventListener("DOMContentLoaded", function () {
    const toast = document.getElementById("toast-notification");

    if (toast) {
        // 1. Munculkan dengan animasi (Slide in)
        setTimeout(() => {
            toast.classList.remove("translate-x-full", "opacity-0");
        }, 100);

        // 2. Hilangkan otomatis setelah 4 detik
        setTimeout(() => {
            closeToast(); // Panggil fungsi di bawah
        }, 4000);
    }
});

// PENTING: Kita pasang ke 'window' agar bisa dipanggil oleh onclick="..." di HTML
window.closeToast = function () {
    const toast = document.getElementById("toast-notification");
    if (toast) {
        // Slide out ke kanan
        toast.classList.add("translate-x-full", "opacity-0");
        // Hapus dari DOM setelah animasi selesai
        setTimeout(() => {
            toast.remove();
        }, 300);
    }
};

// ... kode toast sebelumnya ...

// --- Logika Delete Modal ---

window.openDeleteModal = function (actionUrl) {
    const modal = document.getElementById("delete-modal");
    const modalContent = document.getElementById("delete-modal-content");
    const deleteForm = document.getElementById("delete-form");
    const confirmBtn = document.getElementById("confirm-delete-btn");

    if (modal) {
        // 1. Set URL action form sesuai ID properti yang diklik
        deleteForm.action = actionUrl;

        // 2. Tampilkan modal (Hapus class hidden)
        modal.classList.remove("hidden");

        // 3. Animasi Muncul (Scale up)
        setTimeout(() => {
            modalContent.classList.remove("scale-95", "opacity-0");
            modalContent.classList.add("scale-100", "opacity-100");
        }, 10); // Delay kecil agar transisi CSS jalan

        // 4. Pasang event listener untuk tombol "Ya, Hapus"
        confirmBtn.onclick = function () {
            deleteForm.submit();
        };
    }
};

window.closeDeleteModal = function () {
    const modal = document.getElementById("delete-modal");
    const modalContent = document.getElementById("delete-modal-content");

    if (modal) {
        // 1. Animasi Hilang (Scale down)
        modalContent.classList.remove("scale-100", "opacity-100");
        modalContent.classList.add("scale-95", "opacity-0");

        // 2. Sembunyikan modal setelah animasi selesai (300ms sesuai durasi default tailwind transition)
        setTimeout(() => {
            modal.classList.add("hidden");
        }, 300);
    }
};

// ... kode delete modal sebelumnya ...

// --- Logika Show Detail Modal ---

window.openShowModal = function (data) {
    const modal = document.getElementById("show-modal");
    const modalContent = document.getElementById("show-modal-content");

    if (modal) {
        // 1. Isi Data Text
        document.getElementById("show-category").innerText = data.category;
        const displayedStatus = data.status;
        document.getElementById("show-status").innerText = displayedStatus;
        document.getElementById("show-location").innerText = data.location;
        document.getElementById("show-area").innerText = data.area + " m²";
        document.getElementById("show-ads-category").innerText =
            data.ads_category;
        document.getElementById("show-description").innerText =
            data.description;
        document.getElementById("show-specifications").innerText =
            data.specifications;

        // Handle Email (Karena data user ada di relasi, kadang di JSON terpisah strukturnya)
        // Jika data.user ada (eager loading), pakai emailnya. Jika tidak, pakai placeholder.
        document.getElementById("show-email").innerText = data.user
            ? data.user.email
            : "No Email Data";

        // 2. Format Harga ke Rupiah
        let price = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
        }).format(data.price);
        document.getElementById("show-price").innerText = price;

        // 3. Handle Gambar
        const imgElement = document.getElementById("show-image");
        if (data.image) {
            // Cek apakah link gambar sudah full path atau perlu ditambah base url
            // Karena kita pakai asset() di blade, di sini kita asumsikan path dari DB perlu '/storage' jika belum ada
            // TAPI, cara paling aman kirim path bersih:
            imgElement.src = data.image;
        } else {
            imgElement.src =
                "https://via.placeholder.com/600x400?text=No+Image";
        }

        // 4. Handle Dokumen Link
        const docLink = document.getElementById("show-document-link");
        if (data.document) {
            docLink.href = data.document;
            docLink.classList.remove("hidden");
        } else {
            docLink.href = "#";
            docLink.classList.add("hidden");
        }

        // 5. Tampilkan Modal dengan Animasi
        modal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove("scale-95", "opacity-0");
            modalContent.classList.add("scale-100", "opacity-100");
        }, 10);
    }
};

window.closeShowModal = function () {
    const modal = document.getElementById("show-modal");
    const modalContent = document.getElementById("show-modal-content");

    if (modal) {
        modalContent.classList.remove("scale-100", "opacity-100");
        modalContent.classList.add("scale-95", "opacity-0");

        setTimeout(() => {
            modal.classList.add("hidden");
        }, 300);
    }
};

// --- Logika Show Modal untuk User (Users Index) ---
window.openUserModal = function (data) {
    const modal = document.getElementById("user-show-modal");
    const modalContent = document.getElementById("user-show-modal-content");

    if (modal) {
        document.getElementById("user-show-name").innerText = data.name || "-";
        document.getElementById("user-show-email").innerText =
            data.email || "-";
        document.getElementById("user-show-phone").innerText =
            data.phone || "-";
        document.getElementById("user-show-role").innerText =
            data.role === "admin"
                ? "Admin"
                : data.properties && data.properties.length > 0
                ? "Penjual"
                : "Pencari";
        document.getElementById("user-show-joined").innerText = data.created_at
            ? new Date(data.created_at).toLocaleDateString()
            : "-";

        modal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove("scale-95", "opacity-0");
            modalContent.classList.add("scale-100", "opacity-100");
        }, 10);
    }
};

window.closeUserShowModal = function () {
    const modal = document.getElementById("user-show-modal");
    const modalContent = document.getElementById("user-show-modal-content");

    if (modal) {
        modalContent.classList.remove("scale-100", "opacity-100");
        modalContent.classList.add("scale-95", "opacity-0");
        setTimeout(() => {
            modal.classList.add("hidden");
        }, 300);
    }
};
