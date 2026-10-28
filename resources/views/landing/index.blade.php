@extends('layouts.app')

@section('title', 'Landeuh Village Riverside - Glamping & Villa Tepi Sungai di Bogor')
@section('meta_description', 'Glamping tepi sungai di Bogor dengan suasana sejuk pegunungan. Pilihan kabin kayu, rumah industrial, & paket gathering kantor. Cek ketersediaan dan reservasi online sekarang!')
@section('meta_keywords', 'glamping bogor, glamping tepi sungai, landeuh village riverside, villa tepi sungai bogor, cabin bogor, penginapan tepi sungai bogor, glamping keluarga bogor, paket gathering kantor bogor')
@section('canonical_url', url('/'))

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Kapan waktu check-in dan check-out di Landeuh Village Riverside?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Check-in dimulai pukul 14.00 – 21.00 WIB dan check-out maksimal pukul 12.00 WIB."
      }
    },
    {
      "@type": "Question",
      "name": "Jenis akomodasi apa saja yang tersedia di Landeuh Village Riverside?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Landeuh Village Riverside menawarkan pilihan akomodasi berupa cabin kayu, rumah industrial, dan glamping bernuansa alami di tepi aliran sungai yang sejuk."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah Landeuh Village Riverside cocok untuk liburan keluarga dan rombongan?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sangat cocok. Area yang luas, suasana alam asri, serta beragam pilihan akomodasi menjadikan Landeuh Village Riverside ideal untuk liburan keluarga, arisan, maupun kumpul bersama orang terdekat."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah tersedia paket untuk gathering perusahaan atau komunitas?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tentu. Landeuh Village Riverside menyediakan paket corporate untuk perusahaan, instansi, dan komunitas, lengkap dengan akomodasi, makan 3 kali, dan area gathering outdoor tepi sungai."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah tersedia tempat makan di area Landeuh Village Riverside?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tersedia Kedai Wangun di area penginapan untuk bersantai dan menikmati hidangan hangat selama menginap."
      }
    },
    {
      "@type": "Question",
      "name": "Bagaimana cara melakukan reservasi di Landeuh Village Riverside?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Reservasi dapat dilakukan langsung secara online melalui situs resmi landeuhvillage.com dengan ketersediaan kamar yang terupdate secara realtime."
      }
    }
  ]
}
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
