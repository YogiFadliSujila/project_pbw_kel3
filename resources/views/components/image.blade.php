@props([
    'src' => null,
    'alt' => '',
    'class' => '',
    'placeholder' => null,
    'loading' => 'lazy',
    'decoding' => 'async',
])

@php
    $defaultSvgMarkup = '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600"><rect fill="#F3F4F6" width="100%" height="100%"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9CA3AF" font-family="Inter, Arial, sans-serif" font-size="28">No Image</text></svg>';
    $defaultSvg = 'data:image/svg+xml;utf8,' . rawurlencode($defaultSvgMarkup);

    // Gunakan placeholder yang diberikan, atau file publik images/placeholder.png, lalu fallback ke SVG inline
    $placeholderAsset = $placeholder ?? asset('images/placeholder.png');
    if ($placeholderAsset === asset('images/placeholder.png') && !file_exists(public_path('images/placeholder.png'))) {
        $placeholderAsset = $defaultSvg;
    }

    $srcResolved = $src;

    if (empty($srcResolved)) {
        $srcResolved = $placeholderAsset;
    } else {
        if (!\Illuminate\Support\Str::startsWith($srcResolved, ['http://', 'https://', 'data:'])) {
            // Cek apakah file ada di public
            if (file_exists(public_path(ltrim($srcResolved, '/')))) {
                $srcResolved = asset(ltrim($srcResolved, '/'));
            } else {
                try {
                    if (config('filesystems.disks.s3')) {
                        $srcResolved = \Illuminate\Support\Facades\Storage::disk('s3')->url($srcResolved);
                    } else {
                        $srcResolved = asset(ltrim($srcResolved, '/'));
                    }
                } catch (\Exception $e) {
                    $srcResolved = $placeholderAsset;
                }
            }
        }
    }
@endphp

<img
    src="{{ $srcResolved }}"
    alt="{{ $alt }}"
    class="{{ $class }}"
    loading="{{ $loading }}"
    decoding="{{ $decoding }}"
    onerror="this.onerror=null;this.src='{{ $placeholderAsset }}';"
>
