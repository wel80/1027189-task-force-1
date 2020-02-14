new autoComplete({
	data: {
		src: async () => {
			// User search query
			const query = document.querySelector("#autoComplete").value;
			// Fetch External Data Source
			const source = await fetch(
				`../index.php?r=geocode/index&address=${query}`
			);
			// Format data into JSON
			const data = await source.json();
			// Returns Fetched data
			return data;
		},
		key: ["text"],
		cache: false
	},
	sort: (a, b) => {
		if (a.match < b.match) return -1;
		if (a.match > b.match) return 1;
		return 0;
	},
	placeHolder: "Город, улица, дом",
	selector: "#autoComplete",
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
		destination: document.querySelector("#autoComplete"),
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
		result.innerHTML = "No Results";
		document.querySelector("#autoComplete_list").appendChild(result);
	},
	onSelection: feedback => {
		document.querySelector("#coordinates").value = feedback.selection.value.Point.pos;
	}
});