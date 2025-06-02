/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./www/views/**/*.php",
		"./www/widgets/**/*.php",
		"./www/components/**/*.php",
		"./www/modules/**/*.php",
		"./www/layouts/**/*.php",
	],
	theme: {
		extend: {
			colors: {
				// Add your custom colors here
			},
			fontFamily: {
				// Add your custom fonts here
			},
		},
	},
	plugins: [],
	// Enable JIT mode for faster development
	mode: "jit",
};
