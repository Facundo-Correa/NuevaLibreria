{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $publisher->title }}",
    "description": "{{ $publisher->summary !== '' ? $publisher->summary : strip_tags($publisher->body) }}",
    "image": [
        "{{ $publisher->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $publisher->uri() }}"
    }
}
</script>
--}}
