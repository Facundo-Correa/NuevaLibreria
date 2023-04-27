{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $menus->title }}",
    "description": "{{ $menus->summary !== '' ? $menus->summary : strip_tags($menus->body) }}",
    "image": [
        "{{ $menus->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $menus->uri() }}"
    }
}
</script>
--}}
