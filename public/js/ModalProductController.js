// || Controlador de modal 2.0 || //


function openProductModal(isbn){
    // || Conversión a array

    let isbns = [isbn];

    // || Obtención de info del libro
    axios.post('/api/books/isbns', {isbns: isbns}).then(function(response){
        let data = response.data.data[0];

        // || Obtención del modal
        let modal = document.querySelector('.modal-pro-content');

        // || Modificación del titulo
        modal.querySelector('.product-title').innerHTML = data.title;

        // || El editorial
        modal.querySelector('.autor').innerHTML = 'Autor/es: ' + data.author_1 + ' ' + data.author_2 + ' ' + data.author_3 + ' ' ;

        // || El editorial
        modal.querySelector('.editorial').innerHTML = 'Editorial: ' + data.publisher;

        // || El precio

        // || Get offer price ?? :

        modal.querySelector('.product-price').innerHTML = '$' + data.price + ' ars';

        // || La descripción
        modal.querySelector('.product-description').innerHTML = data.shortdescription;

        modal.querySelector('.isbn-book-span').innerHTML = data.isbn;

        // || El isbn
        modal.querySelector('.editorial').id = data.isbn;



        if(data.shortdescription == ''){
            modal.querySelector('.product-description').innerHTML = data.commentary;
        }

        // || Obtención de la imagen
        let image = document.querySelector('.modal-img');
        image.src = '/img/covers/' + data.isbn1 + '.jpg';

    });
}

function addToChartFromModal(){

    // || Obtención del modal
    let modal = document.querySelector('.modal-pro-content');

    // || Obtención del isbn
    let isbn = modal.querySelector('.editorial').id;

    // || Cantidad
    let cantidad = document.querySelector('.cantidad').value;

    if(user != null){
        axios.post('/api/add-carrito', {id: user, cantidad: cantidad, book: isbn}).then(function(response){
            // || Notificar
            show("Producto añadido al carrito");
            // || Recargar carrito
            reloadCart(user);
        });
    }
}

