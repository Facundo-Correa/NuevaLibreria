{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $booklist->title }}",
    "description": "{{ $booklist->summary !== '' ? $booklist->summary : strip_tags($booklist->body) }}",
    "image": [
        "{{ $booklist->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $booklist->uri() }}"
    }
}
</script>
--}}
