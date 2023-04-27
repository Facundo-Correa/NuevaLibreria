{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $clientesinternacionale->title }}",
    "description": "{{ $clientesinternacionale->summary !== '' ? $clientesinternacionale->summary : strip_tags($clientesinternacionale->body) }}",
    "image": [
        "{{ $clientesinternacionale->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $clientesinternacionale->uri() }}"
    }
}
</script>
--}}
