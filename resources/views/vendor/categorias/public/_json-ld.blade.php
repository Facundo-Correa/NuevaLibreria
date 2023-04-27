{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $categoria->title }}",
    "description": "{{ $categoria->summary !== '' ? $categoria->summary : strip_tags($categoria->body) }}",
    "image": [
        "{{ $categoria->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $categoria->uri() }}"
    }
}
</script>
--}}
