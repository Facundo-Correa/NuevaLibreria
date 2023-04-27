{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $feature->title }}",
    "description": "{{ $feature->summary !== '' ? $feature->summary : strip_tags($feature->body) }}",
    "image": [
        "{{ $feature->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $feature->uri() }}"
    }
}
</script>
--}}
