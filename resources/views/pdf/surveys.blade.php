<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Survey</title>
    <style>
        @page {
            margin: 20px 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        h2 {
            margin: 0 0 8px 0;
        }

        .meta {
            font-size: 11px;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 8px;
            vertical-align: top;
        }

        th {
            background: #f0f0f0;
            text-align: left;
        }

        .nowrap {
            white-space: nowrap;
        }

        .small {
            font-size: 11px;
            color: #555;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 10px;
        }

        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body>
    <h2>Laporan Survey {{ $layanan }}</h2>
    <div class="meta">
        Diekspor: {{ now()->format('d M Y H:i') }} • Total baris: {{ $surveys->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th class="nowrap">No</th>
                <th>Layanan</th>
                <th>Kepuasan</th>
                <th>Kritik &amp; Saran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surveys as $i => $s)
                <tr>
                    <td class="nowrap">{{ $i + 1 }}</td>
                    <td>{{ $s->layanan }}</td>
                    <td class="nowrap">
                        {{ $mapKepuasan[$s->kepuasan] ?? $s->kepuasan }}
                        @if (!empty($s->created_at))
                            <div class="small">({{ \Carbon\Carbon::parse($s->created_at)->format('d M Y') }})</div>
                        @endif
                    </td>
                    <td>{{ $s->kritik_saran }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer>Hal. <span class="pagenum"></span></footer>
</body>

</html>
