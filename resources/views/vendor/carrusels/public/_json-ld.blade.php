{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $carrusel->title }}",
    "description": "{{ $carrusel->summary !== '' ? $carrusel->summary : strip_tags($carrusel->body) }}",
    "image": [
        "{{ $carrusel->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $carrusel->uri() }}"
    }
}
</script>
--}}
