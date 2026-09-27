/**
 * Zero Studios Book - Dashboard Main JS (Bootstrap 5.3 Compatible)
 */

document.addEventListener("DOMContentLoaded", function () {
	// 1. Highlight Active Sidebar Item
	const currentURL = window.location.href;
	const listItems = document.querySelectorAll(".side-bar .main-menu .list-item");

	listItems.forEach(function (item) {
		const link = item.querySelector("a");
		if (link && link.href) {
			if (currentURL === link.href || currentURL.startsWith(link.href + "/")) {
				item.classList.add("active");
			}
		}
	});

	// 2. Sidebar Toggle (Mobile & Desktop)
	const menuBtn = document.getElementById("toggleButton");
	const sidebar = document.querySelector(".side-bar");

	if (menuBtn && sidebar) {
		menuBtn.addEventListener("click", function (e) {
			e.preventDefault();
			const isMobile = window.innerWidth <= 768;

			if (isMobile) {
				sidebar.classList.toggle("show");
			} else {
				sidebar.classList.toggle("hide");
			}
		});

		// Close sidebar on mobile when clicking outside
		document.addEventListener("click", function (e) {
			if (window.innerWidth <= 768) {
				if (
					sidebar.classList.contains("show") &&
					!sidebar.contains(e.target) &&
					!menuBtn.contains(e.target)
				) {
					sidebar.classList.remove("show");
				}
			}
		});
	}

	// 3. Localized Live Date Display
	const dateEl = document.getElementById("Date");
	if (dateEl) {
		const today = new Date();
		const options = {
			weekday: "long",
			year: "numeric",
			month: "long",
			day: "numeric",
			timeZone: "Asia/Jakarta",
		};
		try {
			dateEl.textContent = today.toLocaleDateString("id-ID", options);
		} catch (err) {
			dateEl.textContent = today.toDateString();
		}
	}
});
