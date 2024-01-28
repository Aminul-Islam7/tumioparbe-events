// const particlesConfig = {
//     particles: {
//         number: {
//             value: 8,
//             density: {
//                 enable: true,
//                 value_area: 481.0236182596568,
//             },
//         },
//         color: {
//             value: ["#BD10E0", "#B8E986", "#50E3C2", "#FFD300", "#E86363"],
//         },
//         shape: {
//             type: "circle",
//             stroke: {
//                 width: 0,
//                 color: "#000000",
//             },
//         },
//         opacity: {
//             value: 1,
//             random: true,
//             anim: {
//                 enable: false,
//                 speed: 1,
//                 opacity_min: 0,
//                 sync: false,
//             },
//         },
//         size: {
//             value: 100,
//             random: true,
//             anim: {
//                 enable: false,
//                 speed: 4,
//                 size_min: 0.3,
//                 sync: false,
//             },
//         },
//         line_linked: {
//             enable: false,
//             distance: 150,
//             color: "#ffffff",
//             opacity: 0.4,
//             width: 1,
//         },
//         move: {
//             enable: true,
//             speed: 3,
//             direction: "none",
//             random: true,
//             straight: false,
//             out_mode: "out",
//             bounce: false,
//             attract: {
//                 enable: false,
//                 rotateX: 600,
//                 rotateY: 600,
//             },
//         },
//     },
//     interactivity: {
//         detect_on: "window",
//         events: {
//             onhover: {
//                 enable: true,
//                 mode: "bubble",
//             },
//             onclick: {
//                 enable: false,
//                 mode: "remove",
//             },
//             resize: true,
//         },
//         modes: {
//             grab: {
//                 distance: 400,
//                 line_linked: {
//                     opacity: 1,
//                 },
//             },
//             bubble: {
//                 distance: 450,
//                 size: 0,
//                 duration: 2,
//                 opacity: 0.5,
//                 speed: 3,
//             },
//             repulse: {
//                 distance: 400,
//                 duration: 0.4,
//             },
//             push: {
//                 particles_nb: 4,
//             },
//             remove: {
//                 particles_nb: 2,
//             },
//         },
//     },
//     retina_detect: true,
// };

// particlesJS("particles", particlesConfig);

// Dark Mode
document.addEventListener("DOMContentLoaded", function () {
	// Function to toggle dark mode and save state to local storage
	function toggleDarkMode() {
		const body = document.body;
		const icon = document.querySelector(".color-theme-icon");

		// Toggle the dark mode class on the body
		body.classList.toggle("dark-mode");

		// Update the icon class based on dark mode state
		const isDarkMode = body.classList.contains("dark-mode");
		icon.classList.toggle("fa-lightbulb-on", !isDarkMode);
		icon.classList.toggle("fa-lightbulb", isDarkMode);

		// Save the toggled state to local storage
		localStorage.setItem("darkMode", isDarkMode);

		// Refresh AOS animations
		AOS.refresh();
	}

	// Event listener for the dark mode toggle buttons
	const darkModeToggle = document.getElementById("dark-mode-toggle");
	darkModeToggle.addEventListener("click", toggleDarkMode);

	// Function to detect system preference and set initial mode
	function setInitialMode() {
		const prefersDarkMode =
			window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
		const userPreference = localStorage.getItem("darkMode");

		// Set initial mode based on user preference or system preference
		const isDarkMode = userPreference === "true" || (prefersDarkMode && userPreference !== "false");
		document.body.classList.toggle("dark-mode", isDarkMode);

		const icon1 = document.querySelector(".color-theme-icon");
		icon1.classList.toggle("fa-lightbulb-on", !isDarkMode);
		icon1.classList.toggle("fa-lightbulb", isDarkMode);
	}

	// Set the initial mode when the page loads
	setInitialMode();
});

const ticketsField = document.querySelector("#tickets-field");
const totalPriceSpan = document.querySelector("#totalPrice");
const totalSeatSpan = document.querySelector("#totalSeats");

// Increment button
document.querySelector("#increment").addEventListener("click", () => {
	const currentValue = parseInt(ticketsField.value);
	ticketsField.value = currentValue + 1;
	updateTotalPrice();
});

// Decrement button
document.querySelector("#decrement").addEventListener("click", () => {
	const currentValue = parseInt(ticketsField.value);
	if (currentValue > 1) {
		ticketsField.value = currentValue - 1;
	}
	updateTotalPrice();
});

// Update total price function
function updateTotalPrice() {
	const ticketPrice = 1000; // Assuming ticket price is $1000
	const totalPrice = ticketsField.value * ticketPrice;
	totalPriceSpan.textContent = totalPrice;
	// totalSeatSpan.textContent = ticketsField.value;
}

// Initial total price calculation
updateTotalPrice();

$(document).ready(function () {
	console.log("ready!");
	// Client-side Validation for Phone number
	$(document).on("keyup change focus blur", "#phone-field", function () {
		let number = $(this).val();

		if (
			(number.length >= 1 && number[0] !== "0") ||
			(number.length >= 2 && number[1] !== "1") ||
			(number.length >= 3 && !/^[3-9]$/.test(number[2])) ||
			number.length > 11
		) {
			$(this).removeClass("is-valid");
			$(this).addClass("is-invalid");
		} else {
			$(this).removeClass("is-valid");
			$(this).removeClass("is-invalid");
		}

		if (number.match(/^01[3-9]\d{8}$/)) {
			$(this).addClass("is-valid");
			$(this).removeClass("is-invalid");
		}
	});
	$(document).on("blur", "#phone-field", function () {
		let number = $(this).val();

		if (number.length >= 0 && number.length < 11) {
			$(this).removeClass("is-valid");
			$(this).addClass("is-invalid");
		}
	});
});

// Remove all :hover stylesheets on mobile devices
function hasTouch() {
	return (
		"ontouchstart" in document.documentElement ||
		navigator.maxTouchPoints > 0 ||
		navigator.msMaxTouchPoints > 0
	);
}

if (hasTouch()) {
	// remove all the :hover stylesheets
	try {
		// prevent exception on browsers not supporting DOM styleSheets properly
		for (var si in document.styleSheets) {
			var styleSheet = document.styleSheets[si];
			if (!styleSheet.rules) continue;

			for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
				if (!styleSheet.rules[ri].selectorText) continue;

				if (styleSheet.rules[ri].selectorText.match(":hover")) {
					styleSheet.deleteRule(ri);
				}
			}
		}
	} catch (ex) {}
}
