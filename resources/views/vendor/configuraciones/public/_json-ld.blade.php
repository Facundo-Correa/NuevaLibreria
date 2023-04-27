{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $configuracione->title }}",
    "description": "{{ $configuracione->summary !== '' ? $configuracione->summary : strip_tags($configuracione->body) }}",
    "image": [
        "{{ $configuracione->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $configuracione->uri() }}"
    }
}
</script>
--}}
