{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $pregunta->title }}",
    "description": "{{ $pregunta->summary !== '' ? $pregunta->summary : strip_tags($pregunta->body) }}",
    "image": [
        "{{ $pregunta->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $pregunta->uri() }}"
    }
}
</script>
--}}
