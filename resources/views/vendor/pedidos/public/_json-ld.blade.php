{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $pedido->title }}",
    "description": "{{ $pedido->summary !== '' ? $pedido->summary : strip_tags($pedido->body) }}",
    "image": [
        "{{ $pedido->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $pedido->uri() }}"
    }
}
</script>
--}}
