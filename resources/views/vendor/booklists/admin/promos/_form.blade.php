@push('js')
<script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>

@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}
<div class="row">
    <div class="mb-3 col-4">
        {!! BootForm::text('Titulo', 'title') !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select(__('Sección'), 'booklists_sections_id', $sections) !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Posición', 'position', ['' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4']) !!}
    </div>
</div>
<div class="mb-3">
    {!! BootForm::hidden('status')->value('0') !!}
    {!! BootForm::hidden('booklists_types_id')->value(1) !!}
    {!! BootForm::checkbox(__('Published'), 'status') !!}
</div>


<div class="row">
    <div class=mb-2>Libros</div>
    <div class="input_fields_wrap space-x-7 flex-wrap d-flex">
        <!--Por cada barcode registrado en los barcodes del modelo, generacion de un input con el valor registrado-->
        @foreach(old('books', isset($model->books) ? $model->books : []) as $key => $item)
        <div class="form-group" style="margin-right: 10px !important;">
            <input class="form-control barcode-input" name="barcode[]" type="text" value="{{$item}}">
        </div>
        @endforeach

    </div>

    <div class="col-sm-12 mt-2">
        <button class="btn btn-link btn-sm add_field_button" type="button">+ Agregar libro</button>
    </div>


    <div class="col-sm-12 mt-2">
        <button class="btn btn-link btn-sm update-preview-button" type="button">Actualizar previsualizacion</button>
    </div>
    <div id="preview" class="preview">
        <br>
        <h5 style="text-align: center;">Actualice la previsualizacion para poder ver</h5>
    </div>

</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    let self = this;
    $(document).ready(function() {
        let libros = [];
        let isbns = [];
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            //add input box
            var template = `{!! BootForm::text('Codigo', 'barcode[]')->hideLabel()->addClass('barcode-input') !!}`;
            // var template = `<div class="form-group col-sm-2"> <input class="form-control" name="phone_restrictions[]" type="text"></div>`;

            $(wrapper).append(template);

            // || Limpieza de libros
            libros = document.getElementsByClassName('barcode-input');

            // || Control de tamaño
            if (isbns.length < libros.length - 1) {
                isbns = [libros.length];
            }

            // || Escucha y actualizacion
            for (let i = 0; i < libros.length; i++) {
                libros[i].addEventListener('input', function(libro) {
                    isbns[i] = libros[i].value;
                });
            }
        });

        let preview = $(".preview");
        let update_button = $(".update-preview-button");

        $(update_button).click(function(event) {
            event.preventDefault();

            // || Limpieza de libros
            libros = document.getElementsByClassName('barcode-input');

            // || Control de tamaño
            if (isbns.length < libros.length - 1) {
                isbns = [libros.length];
            }

            // || Escucha y actualizacion
            for (let i = 0; i < libros.length; i++) {
                libros[i].addEventListener('input', function(libro) {
                    isbns[i] = libros[i].value;
                });
            }

            // || Info de los libros
            let libros_encontrados = [];
            axios.post('/api/books/isbns', {
                isbns: isbns
            }).then(function(response) {
                libros_encontrados = response.data;

                // || Limpieza del preview
                if (libros_encontrados.length === 0) {

                } else {
                    $(preview).empty();
                }

                // || Generación del html
                let preview_html = "<div class='preview-container' style=\"display:grid; grid-template-columns: auto auto auto auto; justify-content: space-around;\">";

                libros_encontrados.map(function(libro) {

                    let temp_html = "";
                    temp_html += "<div class='card' style='width:5rem; height:20% margin-right: 20px; margin-top:20px; margin-bottom:10px;'>";
                    temp_html += "<a href='/es/libro/" + libro.barcode + "'/>";
                    temp_html += "<img src='https://nuevalibreria.com.ar/images/covers/tapa-nodisponible.jpg' class='card-img-top' style='object-fit:contain; width:100%;'>";
                    temp_html += "</a>";
                    temp_html += "<div style=\"padding:5%; \">";
                    temp_html += "<h5 class='card-title' style=' font-size: 10px; text-align:center;'>" + libro.title + "</h5>";
                    temp_html += "</div>";

                    // || Guardado del html temporal
                    preview_html += temp_html;
                    preview_html += "</div>";
                });

                // || Guardado del preview
                $(preview).append(preview_html);

            });
        });

        /*
            Resumen: Se busca el wrapper, se busca el boton de adicion y se le agrega un event listener de tipo click. Al ser clickeado se genera
            codigo html y se añade al wrapper, de esta manera se agregan los botones.
        */
    });
</script>
@endpush