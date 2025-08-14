import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	const sidebar = document.getElementById('sidebar');
	const overlay = document.getElementById('sidebarOverlay');
	const button = document.getElementById('mobileMenuButton');

	if (!sidebar || !overlay || !button) return;

	const openSidebar = () => {
		sidebar.classList.remove('-translate-x-full');
		overlay.classList.remove('hidden');
	};

	const closeSidebar = () => {
		sidebar.classList.add('-translate-x-full');
		overlay.classList.add('hidden');
	};

	button.addEventListener('click', () => {
		if (sidebar.classList.contains('-translate-x-full')) {
			openSidebar();
		} else {
			closeSidebar();
		}
	});

	overlay.addEventListener('click', closeSidebar);

	// Close on ESC
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') closeSidebar();
	});

	// Close when clicking a link in sidebar (mobile)
	sidebar.querySelectorAll('a').forEach((link) => {
		link.addEventListener('click', () => {
			if (window.innerWidth < 768) {
				closeSidebar();
			}
		});
	});

	// Ensure correct state on resize
	const onResize = () => {
		if (window.innerWidth >= 768) {
			// md and up: sidebar visible, overlay hidden
			sidebar.classList.remove('-translate-x-full');
			overlay.classList.add('hidden');
		} else {
			// mobile: sidebar closed by default
			sidebar.classList.add('-translate-x-full');
			overlay.classList.add('hidden');
		}
	};
	window.addEventListener('resize', onResize);
	onResize();
});
