{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $promocion->title }}",
    "description": "{{ $promocion->summary !== '' ? $promocion->summary : strip_tags($promocion->body) }}",
    "image": [
        "{{ $promocion->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $promocion->uri() }}"
    }
}
</script>
--}}
