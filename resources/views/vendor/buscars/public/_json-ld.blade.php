{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $buscar->title }}",
    "description": "{{ $buscar->summary !== '' ? $buscar->summary : strip_tags($buscar->body) }}",
    "image": [
        "{{ $buscar->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $buscar->uri() }}"
    }
}
</script>
--}}
