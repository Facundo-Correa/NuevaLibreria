{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $mercadolibrepublicacione->title }}",
    "description": "{{ $mercadolibrepublicacione->summary !== '' ? $mercadolibrepublicacione->summary : strip_tags($mercadolibrepublicacione->body) }}",
    "image": [
        "{{ $mercadolibrepublicacione->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $mercadolibrepublicacione->uri() }}"
    }
}
</script>
--}}
