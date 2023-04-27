// || TODO: Migrar todo esto a carrito.vue
function sendToCart(book, cantidad) {
    let c = cantidad;
    if(cantidad == null){
        c = 1;
    }
    axios
        .post('/api/add-carrito', {
            id: user,
            book: book,
            cantidad: c,
        })
        .then(function () {
            // ||  Temporal
            reloadCart(user);
            show("Producto añadido al carrito");
        });
}

function reloadCart(userID) {
    // || Get the chart

    // || Get the chart html: Jquery i hate you i love you gimme me more - Serú girán

    axios.post('/api/obtener-carrito', { id: userID }).then(function (response) {
        let chart = $('.cart-product');

        // || Clear the cart
        $(chart).empty();

        let code = ``;
        let data = response.data;

        // || Update the cart counter
        document.querySelector('.cantidad-carrito').innerHTML = data.length;
        let price = 0;

        for (let i = 0; i < data.length; i++) {
            let content = `
            <div class="single-cart">
                <div class="cart-img">
                    <a href="/es/libro/${data[i].isbn}"><img src="${data[i].image}" alt="book" /></a>
                </div>
                <div class="cart-info">
                    <h5><a href="/es/libro/${data[i].isbn}">${data[i].title}</a></h5>
                    <p>${data[i].quant} x $${data[i].price}</p>
                </div>
                <div class="cart-icon">
                    <a style="cursor:pointer;" onclick="removeFromCart('${data[i].isbn}')"><i class="fa fa-remove"></i></a>
                </div>

            </div>
            `;

            // || Append new code
            $(chart).append(content);
            price += data[i].price;

            // || Actualizar precio total

        }
        document.querySelector('.precioTotal').innerHTML = '$' + price;

        // || Susurrando al oido de mi representante; te odio, te amo, dame más. || //
    });
}

function clearChartListener() {
    document.querySelector('.vaciar-carrito').addEventListener('click', function() {
        // || Html chart
        let chart = $('.cart-product');


        axios.post('/api/vaciar-carrito', {id: user}).then(function(response){


            // || Visual Update
            $(chart).empty();

            // || Counter reset
            document.querySelector('.cantidad-carrito').innerHTML = 0;
            document.querySelector('.precioTotal').innerHTML = 'Carrito vacio';
            show('Carrito vacio');
        })

    });
}

function removeFromCart(isbn) {
    axios.post('/api/eliminar-del-carrito', {id: user, isbn: isbn}).then(function(response){
        reloadCart(user);
        show("Producto removido del carrito");

    });
}

function sendToCartFromDetails(isbn) {
    let cantidad = document.querySelector('.cantidad').value;
    sendToCart(isbn, cantidad);
}

window.onload = function () {
    // || Load the cart
    reloadCart(user);

    // || Clear listener
    clearChartListener();
};
