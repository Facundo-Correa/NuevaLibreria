{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $inicio->title }}",
    "description": "{{ $inicio->summary !== '' ? $inicio->summary : strip_tags($inicio->body) }}",
    "image": [
        "{{ $inicio->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $inicio->uri() }}"
    }
}
</script>
--}}
