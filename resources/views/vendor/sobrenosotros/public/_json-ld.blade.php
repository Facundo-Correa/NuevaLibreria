{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $sobrenosotro->title }}",
    "description": "{{ $sobrenosotro->summary !== '' ? $sobrenosotro->summary : strip_tags($sobrenosotro->body) }}",
    "image": [
        "{{ $sobrenosotro->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $sobrenosotro->uri() }}"
    }
}
</script>
--}}
