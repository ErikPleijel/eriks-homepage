{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        @if ($url['en'])
        <xhtml:link rel="alternate" hreflang="en" href="{{ $url['en'] }}"/>
        <xhtml:link rel="alternate" hreflang="sv" href="{{ $url['sv'] }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $url['en'] }}"/>
        @endif
        @if ($url['lastmod'])
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
    </url>
@endforeach
</urlset>
