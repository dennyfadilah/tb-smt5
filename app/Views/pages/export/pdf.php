<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    h2 {
        text-align: center;
    }

    .label {
        font-weight: bold;
    }

    .data {
        text-indent: 150px;
    }
    </style>
</head>

<body>
    <h2><?= $title ?></h2>
    <hr>

    <p>
        <span class="label">Name </span>
        <span class="data">: <?= $surveyor['marketing_nama'] ?></span>
    </p>
    <p>
        <span class="label">Date Time Survey </span>
        <span class="data">: <?= date('d M Y', strtotime($surveyor['waktu'])) ?></span>
    </p>
    <p>
        <span class="label">Commodity Name</span>
        <span class="data">: <?= $komoditas['nama'] ?></span>
    </p>
    <p>
        <span class="label">Location Name</span>
        <span class="data">: <?= $lokasi['nama'] ?></span>
    </p>
    <p>
        <span class="label">Repeat Orders</span>
        <span class="data">: <?= $surveyor['repeat_order'] == 1 ? 'Iya' : 'Tidak' ?></span>
    </p>
    <p>
        <span class="label">Survey Result</span>
        <span class="data">: <?= $surveyor['hasil_survey'] ?></span>
    </p>



</body>

</html>