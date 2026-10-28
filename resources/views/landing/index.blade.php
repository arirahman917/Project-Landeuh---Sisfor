@extends('layouts.app')

@section('title', 'Landeuh Village Riverside - Glamping & Villa di Pinggir Sungai Bogor')
@section('meta_description', 'Glamping tepi sungai di Bogor dengan kabin kayu asri & villa di pinggir sungai. Tempat liburan keluarga, arena glamping mewah, & paket gathering kantor. Reservasi online sekarang!')
@section('meta_keywords', 'glamping bogor, glamping booking, glamping di bogor, arena glamping, landeuh village riverside, landeuh village riverside glamping & villa, glamping terdekat, glamping tepi sungai, glamping sungai, glamping dekat sungai, penginapan tepi sungai, penginapan di tepi sungai, vila di pinggir sungai bogor, villa di pinggir sungai, penginapan di pinggir sungai bogor, glamping keluarga, glamping keluarga di bogor, glamping keren di bogor, villa glamping di bogor, penginapan glamping bogor, villa glamping bogor, tempat glamping, lokasi glamping, penginapan glamping, glamping mewah, glamping kayu, kemah mewah, paket glamping, paket corporate, cabin bogor, rumah industrial bogor, tempat acara keluarga di bogor, tempat kegiatan gathering')
@section('canonical_url', url('/'))

@push('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => [
    [
      '@type' => 'Question',
      'name' => 'Di mana lokasi Landeuh Village Riverside dan kapan waktu check-in?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Landeuh Village Riverside berlokasi di Karang Tengah, Babakan Madang, Kabupaten Bogor. Lokasi glamping dan villa di pinggir sungai ini sangat asri dan sejuk. Waktu check-in dimulai pukul 14.00 – 21.00 WIB dan check-out maksimal pukul 12.00 WIB.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'Jenis penginapan apa saja yang tersedia di Landeuh Village Riverside Glamping & Villa?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Kami menyediakan pilihan penginapan glamping mewah, glamping kayu tepi sungai, cabin bogor bernuansa alam, serta rumah industrial modern yang nyaman. Setiap unit dirancang dekat aliran sungai alami dengan fasilitas lengkap.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'Apakah Landeuh Village cocok untuk glamping keluarga dan tempat acara keluarga di Bogor?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Sangat cocok! Landeuh Village merupakan arena glamping keluarga di Bogor yang ramah anak dan aman untuk bermain air di sungai. Area yang luas menjadikannya tempat acara keluarga di Bogor yang favorit untuk liburan santai, arisan, maupun staycation.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'Apakah tersedia paket gathering kantor, outbound, atau paket corporate?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Tentu. Landeuh Village Riverside menyediakan paket corporate dan paket glamping khusus tempat kegiatan gathering kantor, outing perusahaan, komunitas, dan retret. Paket sudah lengkap dengan akomodasi, konsumsi 3 kali makan, perlengkapan BBQ, dan area api unggun di pinggir sungai.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'Apa saja daya tarik dan fasilitas penginapan tepi sungai di sini?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Daya tarik utama adalah penginapan di pinggir sungai dengan suasana alam sejuk dan udara pegunungan. Fasilitas yang tersedia meliputi akses langsung bermain air di sungai, perlengkapan BBQ, area api unggun, area bermain anak, Kedai Wangun, dan area parkir gratis.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'Bagaimana cara glamping booking di Landeuh Village Riverside?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Proses glamping booking dapat dilakukan langsung secara online melalui website resmi landeuhvillage.com. Anda dapat mengecek jadwal ketersediaan unit glamping keren dan cabin secara realtime dengan proses reservasi yang mudah dan aman.'
      ]
    ]
  ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
    @include('landing.sections.hero')
    @include('landing.sections.tentang')
    @include('landing.sections.fasilitas')
    @include('landing.sections.jelajahi')
    @include('landing.sections.faq')
    @include('landing.sections.partner-pembayaran')
@endsection
