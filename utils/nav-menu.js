function setNavBarMenu(padre, tit, user) {
    $(document).ready(() => {
        const sideNavBar = $('#side-nav-bar');
        sideNavBar.append(title(tit));

        $.get(
            './utils/getMenuList.php',
            {
                p: padre,
                u: user
            },
            function (data, status) {
                sideNavBar.append($('<div class="container"><a href="#" data-target="nav-mobile" class="top-nav sidenav-trigger waves-effect waves-light circle hide-on-large-only"><i class="material-icons">menu</i></a></div>'));
                sideNavBar.append(principalNav(data));

                var collapsibleElem = document.querySelector('.collapsible');
                var collapsibleInstance = M.Collapsible.init(collapsibleElem, {});

                document.addEventListener('DOMContentLoaded', function () {
                    var elems = document.querySelectorAll('.sidenav');
                    var instances = M.Sidenav.init(elems, {});
                });

                $('.sidenav').sidenav();
            }
        );
    });
}


function title(name) {
    return $('        <nav class="top-nav green darken-4">\n' +
        '            <div class="container">\n' +
        '                <div class="nav-wrapper">\n' +
        '                    <div class="row">\n' +
        '                        <div class="col s12">\n' +
        `                            <h1 style="font-size: 5em; color: white; padding-top: 0" class="header"> 
                                        ${name}
                                     </h1>\n` +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </nav>');
}

function principalNav(menus) {
    const nav = $('<ul id="nav-mobile" class="sidenav sidenav-fixed"></ul>');
    nav.append($('            <li>\n' +
        '                <a id="logo-container" href="menuint.php" style="font-size: 2.6em; padding: 15%" class="brand-logo">\n' +
        '                    Inicio \n' +
        '                </a id="logo-container">\n' +
        '            </li>'));
    nav.append(simpleMenu2(menus));
    //nav.append($('<img style="width: 100%; height: auto; position: absolute; bottom: 0" src="assets/img/nav.png">'));
    return nav;
}

function simpleMenu2(menus) {
    const li1 = $('<li class="no-padding"></li>');
    const ul1 = $('<ul class="collapsible collapsible-accordion"></ul>');


    for (let i = 0; i <= Object.keys(menus).length; i++) {
        const menu = i !== Object.keys(menus).length ? menus[i] : {
            ruta: 'destruirsesiones.php',
            label: 'Cerrar Sesion',
            submenus: {}
        };

        const li2 = $(`<li class="bold"><a href="#" onclick="setRuta('${menu.ruta}')" class="collapsible-header waves-effect waves-green">${menu.label}</a>`);
        const div = $("<div class=\"collapsible-body\"></div>");
        const ul2 = $('<ul></ul>');
        for (let i = 0; i < Object.keys(menu.submenus).length; i++) {
            const tmpMenu = menu.submenus[i];
            ul2.append(simpleMenu(tmpMenu));
        }
        div.append(ul2);
        li2.append(div);
        ul1.append(li2);
    }

    li1.append(ul1);

    return li1;
}

function simpleMenu(menu) {
    return $(`<li><a href="#" onclick="setRuta('${menu.ruta}')" class="waves-effect waves-green">${menu.label}</a></li>`);
}

function setRuta(ruta) {
    if(ruta === 'destruirsesiones.php')
        window.location.href = ruta;

    $("#someFrame").attr("src", ruta);
}