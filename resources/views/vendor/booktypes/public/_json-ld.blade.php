{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $booktype->title }}",
    "description": "{{ $booktype->summary !== '' ? $booktype->summary : strip_tags($booktype->body) }}",
    "image": [
        "{{ $booktype->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $booktype->uri() }}"
    }
}
</script>
--}}
