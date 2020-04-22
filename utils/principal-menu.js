function getCard(data) {
    return $(
        ' <div id="wow" id="wow" class="col s12 m4 l4">\n' +
        '            <div class="card green darken-4">\n' +
        '                <div class="card-content white-text">\n' +
        '                    <span class="card-title" style="font-size: 2em">\n' +
        `                        ${data.label}\n` +
        '                    </span>\n' +
        `                    <p>${data.descripcion}</p>\n` +
        '                </div>\n' +
        '                <div class="card-action">\n' +
        `                    <a href="${data.ruta}">Consultar</a>\n` +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>' +
        '');
}

function setMenuCards(user) {
    $(document).ready(() => {
        const cardContainer = $('#menu-cards-container');
        $.get(
            './utils/getMenuList.php',
            {u: user},
            function (data) {
                for (let i = 0; i < Object.keys(data).length; i++) {
                    cardContainer.append(getCard(data[i]));
                }
            }
        );
    });
}