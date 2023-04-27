{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $search->title }}",
    "description": "{{ $search->summary !== '' ? $search->summary : strip_tags($search->body) }}",
    "image": [
        "{{ $search->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $search->uri() }}"
    }
}
</script>
--}}
