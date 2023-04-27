@php
    
    if($model->textos){
        $textos = json_encode($model->textos);
    }
@endphp

@push('js')
<script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('textos') !!}


<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<files-field :init-files="{{ $model->files }}"></files-field>

@include('core::form._title-and-slug')

<div class="row">

    <div class="mb-3 col-4">
        @if($model->seccion)
        {!! BootForm::select('Seccion', 'seccion')->options(['Home', 'Ofertas', 'Libro'])->select($model->seccion); !!}

        @else
        {!! BootForm::select('Seccion', 'seccion')->options(['Inicio', 'Ofertas', 'Libro'])->select('Inicio'); !!}
        @endif
    </div>

    <div class="mb-3 col-4">
        @if($model->posicion)
        {!! BootForm::select('Posicion', 'posicion')->options(['1', '2', '3', '4'])->select($model->posicion); !!}
        @else
        {!! BootForm::select('Posicion', 'posicion')->options(['1', '2', '3', '4', 'Cabecera'])->select(0); !!}
        @endif
    </div>
</div>

@php
    $old_texts = [];
    if($model->textos){
        $old_texts = $model->textos;
    }
@endphp

<div class="row">
    @if($model->files)
    @for($i=0; $i<count($model->files); $i++)
        <div class="mb-3 col-4">
            
                <p>Imagen {{$i+1}} </p>
            
                <div style="border-radius: 5px; border: 1px solid black; display:flex; justify-content: space-around; flex-direction:column; padding:2%;">
                    <div style="display: flex;">
                        <input type="text" class="form-control texto_img" placeholder="Texto principal" value="">
                        <input type="color" class="texto_img" value="#ff0000" style="height: auto; border: 0px; margin-left:2%;">
                    </div>
                    
                    <div style="display: flex;">
                        <input type="text" class="form-control texto_img" placeholder="Texto secundario">
                        <input type="color" class="texto_img" value="#ff0000" style="height: auto; border: 0px; margin-left:2%;">
                    </div>

                    <div style="display: flex;">
                        <input type="text" class="form-control texto_img" placeholder="Texto terciario" >
                        <input type="color" class="texto_img" value="#ff0000" style="height: auto; border: 0px; margin-left:2%;">

                    </div>

                    <div style="display: flex;">
                        <input type="text" class="form-control texto_img" placeholder="Href" >
                        <input type="color" disabled id="" value="#4A4A4A" style="height: auto; border: 0px; margin-left:2%; visibility: hidden;">

                    </div>

                </div>
        
            </div>
        @endfor


</div>
<button type="button" class="btn btn-success" id="guardar">Guardar textos</button>
<br />
<br />
@endif

<div class="preview" style="display: flex; flex-direction: column; justify-content:center; align-items:center; box-shadow: 0 0 3px black; border-radius: 10px; padding:3%;">
    <h5>Previsualizacion</h5>
    <br />
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="width:60%; height: 300px; background-color:black;">

        <div class="carousel-inner" style="height: 100%;">
            <div class="carousel-item active" style="height: 100%;">
                {{-- Esta linea causa un undefined index 0 cuando no hay archivos en nube --}}
                @if(count($model->files) > 0)
                <img src="/storage/{{$model->files[0]->path}}" style=" width:100%; height:100%; object-fit:contain;" class="d-block w-100">
                @endif
            </div>

            @foreach($model->files as $image)
            @if($image != $model->files[0])
            <div class="carousel-item" style="height: 100%;">
                <img src="/storage/{{$image->path}}" style=" width:100%; height:100%; object-fit:contain;" class="d-block w-100">
            </div>
            @endif
            @endforeach
        </div>


        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<br />

<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

@push('js')
<script>
    

    $(document).ready(function() {
        let old_textos = {!! json_decode($textos) !!};
        console.log(old_textos);
        
        // -- Spawning all the texts values -- //
        let textos = document.getElementsByClassName('texto_img');


        let oldIndex = 0;
        for (let i=0; i<textos.length; i++) {
            if(old_textos[oldIndex]){
                let current = old_textos[oldIndex];

                for (let j=0; j<7; j++) {
                    if(current[j]){
                        textos[i+j].value = current[j];

                    }
                }
                i+=6;
                oldIndex++;
            }
        }

        
        // || ----------------------------------- || //
        let send = document.getElementById("guardar");
        send.addEventListener("click", function(event){
            
            let extraidos = [];
            for (let i = 0; i<textos.length; i++){
                let info = [];
                for(let j = 0; j<7; j++){
                    info.push(textos[j+i].value);
                }
                i+=6;
                extraidos.push(info);
            }


            // || Guardado de los textos
            axios.post('/admin/guardar-textos-carrusel', {
                id: {!! $model->id !!},
                textos: extraidos
                
            }).then(function(response){
                
            });

        });
    });
</script>
@endpush