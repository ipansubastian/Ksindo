if (document.querySelector('#lang-toggle')) {
	var exampleEl = document.querySelector('#lang-toggle')
	var tooltip = new bootstrap.Tooltip(exampleEl, {
		boundary: 'window'
	})
}