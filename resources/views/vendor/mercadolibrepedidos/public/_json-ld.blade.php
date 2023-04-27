{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $mercadolibrepedido->title }}",
    "description": "{{ $mercadolibrepedido->summary !== '' ? $mercadolibrepedido->summary : strip_tags($mercadolibrepedido->body) }}",
    "image": [
        "{{ $mercadolibrepedido->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $mercadolibrepedido->uri() }}"
    }
}
</script>
--}}
