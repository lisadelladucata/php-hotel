<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$filter_parking = false;
if (isset($_GET['parking']) && $_GET['parking'] == '1') {
    $filter_parking = true;
}

$filter_vote = 0;
if (isset($_GET['vote']) && is_numeric($_GET['vote'])) {
    $filter_vote = (int) $_GET['vote'];
}
?>

<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>php-hotel</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body>

    <div class="container ">
      <h1 class="mb-4">Lista Hotel</h1>
      <hr>

    <form method="GET" class="mb-4 row g-3">
      <div class="form-check col-12">
        <input class="form-check-input" type="checkbox" name="parking" value="1"
        <?php if ($filter_parking == true) { echo 'checked'; } ?>>
        <label class="form-check-label">Mostra solo hotel con parcheggio</label>
      </div>
      <div class="col-md-4">
        <label class="form-label">Voto minimo</label>
        <input type="number" name="vote" min="1" max="5" class="form-control" placeholder="inserisci il voto"
          value="<?php echo $filter_vote > 0 ? $filter_vote : ''; ?>">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Filtra</button>
      </div>
    </form>

      <table class="table table-striped">
        <thead >
          <tr>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Parcheggio</th>
            <th>Voto</th>
            <th>Distanza dal centro</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $found = false;

        for ($i = 0; $i < count($hotels); $i++) {
            $hotel = $hotels[$i];
            $show = true;

            if ($filter_parking && !$hotel['parking']) {
                $show = false;
            }

            if ($hotel['vote'] < $filter_vote) {
                $show = false;
            }

            if ($show) {
                $found = true;
                echo '<tr>';
                echo '<td>' . $hotel['name'] . '</td>';
                echo '<td>' . $hotel['description'] . '</td>';
                echo '<td>' . ($hotel['parking'] ? 'Sì' : 'No') . '</td>';
                echo '<td>' . $hotel['vote'] . '</td>';
                echo '<td>' . $hotel['distance_to_center'] . ' km</td>';
                echo '</tr>';
            }
        }
        ?>
      </tbody>
      </table>
    </div>

  </body>
</html>
