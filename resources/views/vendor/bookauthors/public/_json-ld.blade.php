{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $bookauthor->title }}",
    "description": "{{ $bookauthor->summary !== '' ? $bookauthor->summary : strip_tags($bookauthor->body) }}",
    "image": [
        "{{ $bookauthor->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $bookauthor->uri() }}"
    }
}
</script>
--}}
