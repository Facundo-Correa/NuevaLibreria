<link rel="stylesheet" href="/css/posible.css">
@php
// || Actualizar cantidad de libros

$cantidadLibros = 0;
if($model->books_isbns){
$cantidadLibros = (int)(count(explode(',', $model->books_isbns)));
}

$libros = [];
if($cantidadLibros > 0){
$tmp = explode(',', $model->books_isbns);
foreach($tmp as $i){
array_push($libros, $i);
}
}

$descuentos = [];
if($model->books_desc){
$tmpDesc = explode(',', $model->books_desc);
foreach($tmpDesc as $i){
array_push($descuentos, $i);
}
}

$id = $model->id;

@endphp

@push('js')
<script src="/js/NotificationController.js"></script>
<script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

{{-- <file-managerrelated-table="$model->getTable()" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<files-field :init-files="{{ $model->files }}"></files-field> --}}

@include('core::form._title-and-slug')

<div class="row">

    <div class="mb-3 col-4">
        {!! BootForm::select('Página', 'seccion')->options(['Home', 'Ofertas', 'Libros']); !!}
    </div>

    <div class="mb-3 col-4">
        {!! BootForm::select('Posicion', 'posicion')->options(['1', '2', '3', '4'])!!}
    </div>
</div>
@if($id != null)
<div class="row">
    <div class="mb-1 col-2">
        <a onclick="agregarLibro()" class="btn btn-outline-primary">Agregar Libro</a>
    </div>
    <div class="mb-1 col-2">
        <a onclick="guardarLibros()" class="btn btn-outline-primary">Guardar Libros</a>
    </div>
</div>
@endif

<br />
<br />

<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}

    {!! BootForm::hidden('books_isbns')->addClass('books_isbns') !!}
    {!! BootForm::hidden('name') !!}

</div>

<div class="row libros-container">

</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var cantidadLibros = '<?php echo $cantidadLibros; ?>';
    var libros = '<?php echo json_encode($libros); ?>';

    $(document).ready(function() {
        cargarLibros();
    });

    function agregarLibro() {

        let code = `
                    <div class="mb-3 col-4">
                        <div class = "libro" style="margin-bottom: 50px;">
                            <label for="isbn-${cantidadLibros}" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="libro-${cantidadLibros}" placeholder="ISBN"}>
                        </div>
                    </div>
                <br/>
                <br/>
                `;

                /*
                    <label for="price-${cantidadLibros}" class="form-label">Precio Original</label>
                            <input type="text" class="form-control" id="price-${cantidadLibros}" placeholder="Precio"}>

                            <label for="desc-${cantidadLibros}" class="form-label">Descuento</label>
                            <input type="text" class="form-control" id="desc-${cantidadLibros}" placeholder="Descuento"}>
                */

        let container = $('.libros-container');
        $(container).append(code);
        cantidadLibros++;
    }

    function cargarLibros() {
        var descuentos = {!! json_encode($descuentos) !!};


        let infoLibros = [];
        axios.post('/api/books/isbns', {
            isbns: libros
        }).then(function(response) {
            let infoLibros = response.data.data;

            for (let i = 0; i < cantidadLibros; i++) {

                let descuento = '0';
                if (descuentos.length >= i) {
                    descuento = descuentos[i];
                }

                let code = `
                        <div class="mb-3 col-4">
                            <div class = "libro" style="margin-bottom: 50px;">
                                <label for="isbn-${i}" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="libro-${i}" placeholder="ISBN" value="${infoLibros[i].isbn}"}>
                            </div>
                        </div>
                    <br/>
                    <br/>
                    `;

                    /*
                        
                                <label for="price-${i}" class="form-label">Precio Original</label>
                                <input type="text" class="form-control" id="price-${i}" placeholder="Precio" value="${infoLibros[i].price}"}>

                                <label for="desc-${i}" class="form-label">Descuento</label>
                                <input type="text" class="form-control" id="desc-${i}" placeholder="Descuento" value="${descuento}"}>
                    */

                let container = $('.libros-container');
                $(container).append(code);
            }

        });

        // || `` || //



    }

    function guardarLibros() {

        var id = '<?php echo json_encode($id); ?>';
        let precios = '';
        let descuentos = '';

        let books = '';
        let ready = false;

        for (let i = 0; i < cantidadLibros; i++) {
            ready = false;
            // isbn-, price-, desc-
            // precios += ;


            // || Obtención de los libros || //
            let libroSearch = '#libro-' + i;
            //console.log($(libroSearch));

            if ($(libroSearch).val() == '' || $(libroSearch).val() == ' ') {

            } else {
                books += $(libroSearch).val() + ',';

                // || Obtención de los precios || //
                let priceSearch = '#price-' + i;

                if ($(priceSearch).val() == '') {
                    precios += '0,';
                } else {
                    precios += $(priceSearch).val() + ',';
                }


                // || Obtención de los descuentos || //
                let descSearch = '#desc-' + i;
                if ($(descSearch).val() == '') {
                    descuentos += '0,';
                } else {
                    descuentos += $(descSearch).val() + ',';
                }
            }




        }


        let cleanPrice = '';
        let cleanDesc = '';
        let cleanBooks = '';

        // || Limpiado de ultima coma
        for (let i = 0; i < precios.length - 1; i++) {
            cleanPrice += precios[i];
        }

        for (let i = 0; i < descuentos.length - 1; i++) {
            cleanDesc += descuentos[i];
        }

        for (let i = 0; i < books.length - 1; i++) {
            cleanBooks += books[i];
        }

        // || Emision de la info
        axios.post('/admin/promociones/guardar-libros', {
            id: id,
            isbns: cleanBooks,
            precios: cleanPrice,
            descuentos: cleanDesc
        }).then(function(response) {
            show('Promocion actualizada');
            location.reload();
        });



    }
</script>
@endpush
