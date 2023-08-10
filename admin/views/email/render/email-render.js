$(document).ready(() => {
	const form = $('.input-form');
	const element = $('.iframe-data');
	const iframe = $('.email-iframe');
	var json = element.data('details');
	var debounce_timeout = null;
	var debounce_limit = 0;

	const updateIframe = function () {
		const data = readJsonFromForm();
		iframe.attr('src', element.data('src') + '?json=' + JSON.stringify(data));
	}

	const updateJsonInputHeights = function () {
		form.find('textarea').each(function () {
			var rows = ($(this).val().match(/\n/g) || []).length + 1;
			$(this).attr('rows', rows);
		});
	}

	const readJsonFromForm = function () {
		var data = {};
		form.find('textarea').each(function () {
			data[$(this).attr('name')] = $(this).val();
		});

		return data;
	}

	const generateForm = function () {
		form.html('');
		Object.keys(json).forEach(function (key) {
			var value = json[key];
			var is_json = false;
			try {
				value = JSON.stringify(JSON.parse(json[key]), null, 4);
				is_json = true;
			} catch (_) {
				value = json[key];
			}

			try {
				var rows = (value.match(/\n/g) || []).length + 1;

				form.append(`
        <div class="form-group" ` + (key[0] == '_' ? 'style="display: none"' : '') + `>
          <label>` + key + `</label>
          <textarea rows=` + rows + ` class="form-control ` + key + `" style="max-height: 600px" name="` + key + `" id="` + key + `"></textarea>
        </div>
      `);

				$('#' + key).html(value);
			} catch (_) {

			}
		});

		form.find('textarea').keyup(() => debounce(updateIframe));
		form.find('textarea').change(() => debounce(updateIframe));
		form.find('textarea').focus(() => debounce(updateIframe));
		form.find('textarea').blur(() => debounce(updateIframe));
	}

	const debounce = function (handler) {
		updateJsonInputHeights();
		debounce_limit++;
		if (debounce_limit <= 5) {
			clearTimeout(debounce_timeout);
		}

		debounce_timeout = setTimeout(() => {
			debounce_limit = 0;
			handler()
		}, 100);
	}

	generateForm();
	setTimeout(updateIframe, 666);
	setInterval(updateIframe, 3000);
})
