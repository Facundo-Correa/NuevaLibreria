{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $mercadolibrepregunta->title }}",
    "description": "{{ $mercadolibrepregunta->summary !== '' ? $mercadolibrepregunta->summary : strip_tags($mercadolibrepregunta->body) }}",
    "image": [
        "{{ $mercadolibrepregunta->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $mercadolibrepregunta->uri() }}"
    }
}
</script>
--}}
