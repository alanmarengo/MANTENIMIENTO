function slide(id, data) {
    let slide = $(id).find('.carousel-inner');

    for (let i = 0; i < data.length; i++) {
        let item = data[i];
        slide.append(`
			<a href="${item.url}" class="carousel-item ${i == 0 ? 'active' : ''}">
				<img class="d-block w-100" src="${item.imagen}">
				<div class="carousel-caption">
					<p>${item.texto}</p>
				</div>
			</a>
		`);
    }
}