{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $book->title }}",
    "description": "{{ $book->summary !== '' ? $book->summary : strip_tags($book->body) }}",
    "image": [
        "{{ $book->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $book->uri() }}"
    }
}
</script>
--}}
