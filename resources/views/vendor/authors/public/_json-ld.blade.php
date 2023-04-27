{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $author->title }}",
    "description": "{{ $author->summary !== '' ? $author->summary : strip_tags($author->body) }}",
    "image": [
        "{{ $author->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $author->uri() }}"
    }
}
</script>
--}}
