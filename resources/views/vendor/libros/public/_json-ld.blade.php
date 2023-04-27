{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $libro->title }}",
    "description": "{{ $libro->summary !== '' ? $libro->summary : strip_tags($libro->body) }}",
    "image": [
        "{{ $libro->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $libro->uri() }}"
    }
}
</script>
--}}
