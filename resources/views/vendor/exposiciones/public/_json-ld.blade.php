{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $exposicione->title }}",
    "description": "{{ $exposicione->summary !== '' ? $exposicione->summary : strip_tags($exposicione->body) }}",
    "image": [
        "{{ $exposicione->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $exposicione->uri() }}"
    }
}
</script>
--}}
