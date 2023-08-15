'use strict';

const ALERT_ANIMATION_STEP_TIME = 300;
const ALERT_AUTO_HIDE_TIME = 30000;
var scroll_delayer = null;

window.addEventListener('DOMContentLoaded', (event) => {
	document.querySelectorAll('.copy-click')
		.forEach(element => {
			element.addEventListener("click", () => {
				var textArea = document.createElement("textarea");
				textArea.value = element.innerText.trim();
				textArea.style.top = "0";
				textArea.style.left = "0";
				textArea.style.position = "fixed";
				document.body.appendChild(textArea);
				textArea.focus();
				textArea.select();
				document.execCommand('copy');
				document.body.removeChild(textArea);
				addAlert('info', 'Copied!');
			});
		});
});

window.addEventListener('scroll', function () {
	clearTimeout(scroll_delayer);
	scroll_delayer = setTimeout(function () {
		const elements = document.querySelectorAll('.submit-on-show:not(.submitted)');

		for (var i = 0; i < elements.length; i++) {
			const element = elements[i];
			const rect = element.getBoundingClientRect();

			const is_in_window =
				rect.top >= 0 &&
				rect.left >= 0 &&
				rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
				rect.right <= (window.innerWidth || document.documentElement.clientWidth);

			if (is_in_window) {
				element.classList.add('submitted');
				element.click();
			}
		}
	}, 100);
});

function makeid(length) {
	var result = '';
	var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var charactersLength = characters.length;
	for (var i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}

function addAlert(type, message, buttons = [], duration = 5000) {
	var path = '';

	switch (type) {
		case 'info': {
			path = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
		}
			break;
		case 'success': {
			path = 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
		}
			break;
		case 'warning': {
			path = 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z';
		}
			break;
		case 'error': {
			path = 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z';
		}
			break;
	}

	const uuid = 'alert-' + makeid(10);
	document.querySelector('.alert-wrapper').insertAdjacentHTML('beforeend', `
	<div id='${uuid}' class='alert autohide alert-${type} shadow-lg right-0 mb-1 mr-1 cursor-pointer transition-all'>
		<div>
			<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-current flex-shrink-0 w-6 h-6'>
				<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='${path}'></path>
			</svg>
			<span>${message}</span>
		</div>
		<div class='flex-none'>
		${buttons.map(button => {
		return `<a href='${button['url']}' class='btn btn-sm btn-secondary'>${button['label']}</a>`
	})}
			<button class='btn btn-sm btn-primary' onclick='onAlertClicked(this)'>Ok</button>
		</div>
	</div>
	`);

	setTimeout(() => {
		hideAlert(document.getElementById(uuid));
	}, duration);
}

function onAlertClicked(element) {
	const alert_root = element.parentElement.parentElement;
	hideAlert(alert_root);
}

function hideAlert(alert_root) {
	alert_root.classList.add('duration-' + ALERT_ANIMATION_STEP_TIME);
	alert_root.classList.add('translate-x-full');
	setTimeout(() => hideAlertTransformUp(alert_root), ALERT_ANIMATION_STEP_TIME);
}

function hideAlertTransformUp(alert_root) {
	alert_root.classList.add('-translate-y-full');
	alert_root.classList.add('max-h-0');
	alert_root.classList.add('overflow-hidden');
	alert_root.classList.add('m-0');
	alert_root.classList.add('p-0');
	setTimeout(() => hideAlertRemove(alert_root), ALERT_ANIMATION_STEP_TIME);
}

function hideAlertRemove(alert_root) {
	alert_root.remove();
}

function autoHideAlerts() {
	const alerts = document.getElementsByClassName('alert autohide');
	for (var i = 0; i < alerts.length; i++) {
		const alert = alerts[i];
		setTimeout(() => {
			hideAlert(alert);
		}, (alerts.length - i) * ALERT_ANIMATION_STEP_TIME);
	}
}

setTimeout(autoHideAlerts, ALERT_AUTO_HIDE_TIME);


function setCookie(name, value, days) {
	var expires = "";
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

setTimeout(() => {
	const elements = document.querySelectorAll('[data-set-theme]');

	const setActiveTheme = function (theme) {
		localStorage.setItem('data-set-theme', theme);
		setCookie('data-set-theme', theme, false);
		document.getElementsByTagName('html')[0].setAttribute('data-theme', theme);
	}

	const onThemeSelected = function (element) {
		const theme = element.getAttribute('data-set-theme');
		setActiveTheme(theme);
	}

	const addEventToThemeButton = function (element) {
		element.addEventListener('click', () => onThemeSelected(element));
	}

	elements.forEach(addEventToThemeButton);

	if (localStorage.getItem('data-set-theme') != null) {
		setActiveTheme(localStorage.getItem('data-set-theme'));
	}

	if (document.getElementsByTagName('html')[0].hasAttribute('data-theme-force')) {
		setActiveTheme(document.getElementsByTagName('html')[0].getAttribute('data-theme-force'));
	}
}, 1);


function onFileClicked(callback, value, meta) {
	//alert ('to be implemented');

	var input = document.getElementById('tmp-file');
	input.click();
	input.onchange = function () {
		var file = input.files[0];
		var reader = new FileReader();
		reader.onload = function (e) {
			callback(e.target.result, {
				alt: file.name
			});
		};
		reader.readAsDataURL(file);
	};
}

document.addEventListener('DOMContentLoaded', function () {
	const tab_groups = Array.from(document
		.querySelectorAll('[tab-group]'))
		.map(function (group_element) {
			return group_element.getAttribute('tab-group')
		})
		.filter(function (value, index, self) {
			return self.indexOf(value) === index;
		});

	const setQueryParam = function (key, value) {
		var query_params = new URLSearchParams(window.location.search);
		query_params.set(key, value);
		history.replaceState(null, null, "?" + query_params.toString());
	}

	const getQueryParam = function (key) {
		var query_params = new URLSearchParams(window.location.search);
		return query_params.get(key);
	}

	tab_groups.forEach(function (tab_group) {
		const tab_buttons = document.querySelector('[role="tab-buttons"][tab-group="' + tab_group + '"]').querySelectorAll('[role="tab-button"]');
		const tab_panels = document.querySelector('[role="tab-panels"][tab-group="' + tab_group + '"]').querySelectorAll('[role="tab-panel"]');

		const clearTabsAndButtons = function () {
			tab_buttons.forEach(function (button) {
			  if (button.classList.contains('active')) {
				 button.classList.remove('active');
			  }
			});
	
			tab_panels.forEach(function (panel) {
			  if (panel.classList.contains('show')) {
				 panel.classList.remove('show');
			  }
	
			  if (panel.classList.contains('active')) {
				 panel.classList.remove('active');
			  }
	
			  if (!panel.classList.contains('hidden')) {
				 panel.classList.add('hidden');
			  }
			});
		 };

		const switchToTab = function (button) {
			const target = button.getAttribute('tab-target');
			clearTabsAndButtons();
			document.querySelectorAll('#' + target)
				.forEach(function (element) {
					if (element.classList.contains('hidden')) {
						element.classList.remove('hidden');
					 }
					if (!element.classList.contains('show')) {
						element.classList.add('show');
					}
					if (!element.classList.contains('active')) {
						element.classList.add('active');
					}
				});
			if (!button.classList.contains('active')) {
				button.classList.add('active');
			}

			setQueryParam(tab_group, target);
		}

		tab_buttons.forEach(function (button) {
			button.addEventListener('click', function () {
				switchToTab(button);
			});
		});

		const initial_buttons = Array.from(tab_buttons)
			.filter(function (button) {
				return button.getAttribute('tab-target') == getQueryParam(tab_group);
			});

		if (initial_buttons.length > 0) {
			switchToTab(initial_buttons[0]);
		} else {
			switchToTab(tab_buttons[0]);
		}
	});
});


const updateExportButtons = function () {
	const elements = document.querySelectorAll('[export-id]');

	var uri = 'data:application/vnd.ms-excel;base64,'
		, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
		, base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
		, format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }


	elements.forEach(function (element) {
		const target = element.getAttribute('export-id');
		var timeout_handler = null;

		const onExportClicked = function () {
			clearTimeout(timeout_handler);
			timeout_handler = setTimeout(function () {
				var table = document.querySelector(target);
				var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

				var dlink = document.createElement('a');
				dlink.setAttribute('id', 'dlink');
				document.body.append(dlink);

				setTimeout(function () {
					dlink.href = uri + base64(format(template, ctx));
					dlink.download = document.title + '.xls';
					dlink.click();
					dlink.remove();
				}, 10);
			}, 100);
		}

		element.removeEventListener('click', onExportClicked);
		element.addEventListener('click', onExportClicked);
	});
}

document.addEventListener('DOMContentLoaded', updateExportButtons);

setTimeout(updateExportButtons, 1);


document.addEventListener('show-popup', function ({ detail }) {
	const { title, body, resolve } = detail;

	const popup = document.querySelector('.popup-class');

	popup.querySelector('.popup-title').innerHTML = title;
	popup.querySelector('.popup-content').innerHTML = body;

	var old_element = popup.querySelector('.popup-content-wrapper');
	var new_element = old_element.cloneNode(true);
	old_element.parentNode.replaceChild(new_element, old_element);

	popup.querySelector('.popup-footer').querySelector('button').addEventListener('click', function () {
		document.querySelector('#popup-wrapper').click();
		resolve (new FormData(popup.querySelector('.popup-content-wrapper')));
	});

	document.querySelector('#popup-wrapper').click();
});

const openPopup = function (title, body) {
	return new Promise(function (resolve, reject) {
		const event = new CustomEvent('show-popup', {
			detail: {
				title,
				body,
				resolve,
				reject
			}
		});

		document.dispatchEvent(event);
	});
}