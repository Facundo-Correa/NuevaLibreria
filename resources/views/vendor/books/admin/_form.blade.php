@push('js')
<script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

@if ($tags->count() > 0)
<div class="mb-2">Tags</div>
<div class="w-100 d-flex mb-4">
    @foreach ( $tags as $singletag )
    <div style="background-color: #495057; color:white; padding: 0.15rem 0.5rem; margin-right: 20px; border-radius: 0.25rem; font-size: 15px; font-weight: 500; display: flex;">
        @if(in_array($singletag->id, $modeltags))
        {!! BootForm::checkbox( $singletag->tag, 'tags[]')->value($singletag->id)->check()->hideLabel()->addClass('form-check-input')->addClass('mb-0') !!} {{$singletag->tag}}
        @else
        {!! BootForm::checkbox( $singletag->tag, 'tags[]')->value($singletag->id)->uncheck()->hideLabel()->addClass('form-check-input')->addClass('mb-0') !!} {{$singletag->tag}}
        @endif
    </div>
    @endforeach
</div>
@endif

{!! BootForm::textarea(__('Indice'), 'descriptions.indice')->rows(4) !!}
{!! BootForm::textarea(__('Description'), 'descriptions.description')->rows(4) !!}