new autoComplete({
	data: {
		src: async () => {
			// User search query
			const query = document.querySelector("#taskform-address").value;
			// Fetch External Data Source
			const source = await fetch(`http://yii-taskforce/geocode/${query}`);
			// Format data into JSON
			const data = await source.json();
			// Returns Fetched data
			return data;
		},
		key:['name'],
		cache: false
	},
	sort: (a, b) => {
		if (a.match < b.match) return -1;
		if (a.match > b.match) return 1;
		return 0;
	},
	placeHolder: "Город улица дом",
	selector: "#taskform-address",
	threshold: 0,
	debounce: 0,
	searchEngine: "strict",
	highlight: true,
	maxResults: 5,
	resultsList: {
		render: true,
		container: source => {
      source.setAttribute("id", "autoComplete_list");
		},
		destination: document.querySelector("#taskform-address"),
		position: "afterend",
		element: "ul"
	},
	resultItem: {
		content: (data, source) => {
      source.innerHTML = data.match;
		},
		element: "li"
	},
	noResults: () => {
		const result = document.createElement("li");
		result.setAttribute("class", "no_result");
		result.setAttribute("tabindex", "1");
		result.innerHTML = "Ничего не найдено...";
		document.querySelector("#autoComplete_list").appendChild(result);
	},
	onSelection: feedback => {
		document.querySelector("#taskform-address").value = feedback.selection.value.name;
		document.querySelector("#taskform-longitude").value = feedback.selection.value.longitude;
		document.querySelector("#taskform-latitude").value = feedback.selection.value.latitude;
	}
});