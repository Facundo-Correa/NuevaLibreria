{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $listado->title }}",
    "description": "{{ $listado->summary !== '' ? $listado->summary : strip_tags($listado->body) }}",
    "image": [
        "{{ $listado->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $listado->uri() }}"
    }
}
</script>
--}}
