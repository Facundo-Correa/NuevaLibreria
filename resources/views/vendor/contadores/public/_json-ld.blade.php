{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $contadore->title }}",
    "description": "{{ $contadore->summary !== '' ? $contadore->summary : strip_tags($contadore->body) }}",
    "image": [
        "{{ $contadore->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $contadore->uri() }}"
    }
}
</script>
--}}
