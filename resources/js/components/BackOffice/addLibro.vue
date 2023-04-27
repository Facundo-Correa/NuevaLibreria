<template>
    <div id="addDivLibroGeneral">
        <h4>Agregar Libros</h4>
        <a class="btn btn-success" v-on:click="writeData()">Añadir</a>
        <input
            type="text"
            placeholder="Cantidad de libros a agregar"
            v-model="input_cantidad"
            v-on:input="parseCant()"
            class="book-input"
        />
        <div id="addLibroGeneral">
            <div v-for="libro in cantidad_libros" :key="libro">
                <input
                    style="margin: 2%"
                    type="text"
                    :placeholder="'ISBN ' + libro"
                    :id="libro"
                    v-on:input="setInfo(libro)"
                />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            input_cantidad: '',
            cantidad_libros: 0,
            libros: [],
            dataBooks: [],
        };
    },
    mounted() {
        // ||
    },
    methods: {
        setInfo(number) {
            if (this.libros.length < number - 1) {
                this.libros.push('');
            }
            this.libros[number] = document.getElementById(number).value;
        },
        parseCant() {
            this.cantidad_libros = parseInt(this.input_cantidad);
        },
        writeData() {
            let self = this;

            // || Cierre del componente
            document.getElementById(self.switch).style.display = 'none';
            // || Por cada isbn en libros, obtener la data original desde el server
            axios
                .post('/api/books/isbns', {
                    isbns: this.libros,
                })
                .then(function (response) {
                    self.dataBooks = response.data;

                    // || Una vez obtenidos los libros generar el codigo HTML a insertar.
                    // || Por preferencia estetica, se utilizara grid design
                    let htmlToInsert = self.generateGridDesign(self.dataBooks);

                    // || Finalmente, la escritura
                    CKEDITOR.instances[self.editor_id].insertHtml(htmlToInsert);

                    // || Dudas de como funciona aca el CKEditor sin importarlo? Lo mas probable es que este instalado mediante npm y utilizado en el master.blade.php

                    // || Bueno, como nada es tan sencillo como deberia, el formulario del Page dejo de funcionar
                });
        },
        generateGridDesign(books) {
            // || Resultado objetivo
            /*
                <a class="editorial-container" style="display:grid; grid-template-columns: auto auto auto auto;" href="path/bookName">
                    <div class = "libro" style = "margin-right: 5%;">
                        <img class="book_img"></img>
                        <p class="book_title" style="bold">book.title</p>
                        <p class="book_description" style="">book.description</p>
                        <p class="book_price" style="bold">book.price</p>
                    </div>
                </a>
            */
            let self = this;
            let htmlToReturn = '';
            htmlToReturn += "<h2 style='text-align:center;'>";
            htmlToReturn += '[Titulo]';
            htmlToReturn += '</h2>';
            htmlToReturn +=
                '<div class=\'editorial_container\' style="justify-content:space-around; display:grid; grid-template-columns: auto auto auto auto; width:100%; padding:2%;">';

            /* 
            || FIRST VERSION ||
            
            htmlToReturn +=
                
            for (let i = 0; i < books.length; i++) {
                let localHtml = '<div style="margin-right:5%;">';

                localHtml += "<a href='" + self.path + "/" + books[i].isbn + '\' style="border: 0px solid black;">';

                localHtml += '<img src=' + self.getImageUrl(books[i].image_name) + '>';
                localHtml += '</img>';

                localHtml += '<p style="text-align:center; margin-top: 2%;">';
                localHtml += books[i].title;
                localHtml += '</p>';

                localHtml += '</a>';

                localHtml += '<p style="text-align:center; margin-top: 2%;">';
                localHtml += books[i].shortdescription;
                localHtml += '</p>';

                localHtml += '<p style="text-align:center; margin-top: 2%;">';
                localHtml += books[i].price + '$';
                localHtml += '</p>';

                localHtml += '</div>';

                htmlToReturn += localHtml;
            }
            htmlToReturn += '</div>';
            console.log(htmlToReturn);*/

            /* CARD
                <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                </div>
            */

            for (let i = 0; i < books.length; i++) {
                let local = "<div class='card' style='width:10rem; height:20% margin-right: 20px; margin-bottom:10px;'>";
                let path = self.path + '/' + books[i].isbn;
                local+="<a href='" + path + "'>";
                if(!books[i].image_name){
                    local += "<img src='" + 'https://nuevalibreria.com.ar/images/covers/tapa-nodisponible.jpg' + "' class='card-img-top' style='object-fit:contain; width:100%;'/> </img>";
                }
                local+="</a>";
                local += "<div style='padding: 5%;'>";
                local += "<h5 class='card-title' style=' font-size: 10px; text-align:center;'>" + books[i].title + '</h5>';/*
                local += "<p class='card-text'>" + books[i].shortdescription + '</p>';
                local += "<a href='" + self.path + '/' + books[i].isbn + "' class='btn btn-primary'>Ver libro</a>";*/

                local += '</div>';

                // || Cierre div card
                local += '</div>';

                htmlToReturn += local;
            }

            // || Cierre del div grid
            htmlToReturn += '</div>';
            return htmlToReturn;
        },
        getImageUrl() {
            return 'https://i.ytimg.com/an_webp/-bI0diefasA/mqdefault_6s.webp?du=3000&sqp=CLCU6o8G&rs=AOn4CLDpQDWMDk57XH-mYFgRlroCbn4w1w';
        },
    },
    props: {
        editor_id: {
            type: String,
            required: true,
        },
        path: {
            type: String,
            required: true,
        },
        switch: {
            type: String,
            required: true,
        },
    },
};
</script>

<style>
#addDivLibroGeneral {
    display: flex;
    align-items: center;
    justify-content: center;

    flex-direction: column;

    border-radius: 2%;
    box-shadow: 0 0 2px black;
    margin-bottom: 2%;
}

#addDivLibroGeneral h4 {
    margin: 2%;
}

#addLibroGeneral {
    display: grid;
    justify-content: center;
    grid-template-columns: auto auto auto auto;
}

#addDivLibroGeneral a {
    margin: 2%;
    color: white;
}

.book-input {
    margin: 2%;
}
</style>