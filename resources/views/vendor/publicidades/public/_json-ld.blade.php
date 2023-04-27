{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $publicidade->title }}",
    "description": "{{ $publicidade->summary !== '' ? $publicidade->summary : strip_tags($publicidade->body) }}",
    "image": [
        "{{ $publicidade->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $publicidade->uri() }}"
    }
}
</script>
--}}
