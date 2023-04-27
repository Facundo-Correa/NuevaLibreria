{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $bookcategory->title }}",
    "description": "{{ $bookcategory->summary !== '' ? $bookcategory->summary : strip_tags($bookcategory->body) }}",
    "image": [
        "{{ $bookcategory->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $bookcategory->uri() }}"
    }
}
</script>
--}}
