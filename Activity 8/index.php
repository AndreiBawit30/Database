<?php
include("connect.php");

$aircraftTypeFilter = isset($_GET['aircraftType']) ? $_GET['aircraftType'] : '';
$airlinesNameFilter = isset($_GET['airlineName']) ? $_GET['airlineName'] : '';
$pilotNameFilter = isset($_GET['pilotName']) ? $_GET['pilotName'] : '';
$departureTimeFilter = isset($_GET['departureTime']) ? $_GET['departureTime'] : '';
$arrivalTimeFilter = isset($_GET['arrivalTime']) ? $_GET['arrivalTime'] : '';
$creditCardFilter = isset($_GET['creditCard']) ? $_GET['creditCard'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : "";
$order = isset($_GET['order']) ? $_GET['order'] : "";

$query = "SELECT * FROM flightlogs";
$addQuery = '';

if ($aircraftTypeFilter != '') {
    $addQuery .= "aircraftType = '$aircraftTypeFilter' AND ";
}
if ($airlinesNameFilter != '') {
    $addQuery .= "airlineName = '$airlinesNameFilter' AND ";
}
if ($pilotNameFilter != '') {
    $addQuery .= "pilotName = '$pilotNameFilter' AND ";
}
if ($departureTimeFilter != '') {
    $addQuery .= "YEAR(departureDatetime) = '$departureTimeFilter' AND ";
}
if ($arrivalTimeFilter != '') {
    $addQuery .= "YEAR(arrivalDatetime) = '$arrivalTimeFilter' AND ";
}
if ($creditCardFilter != '') {
    $addQuery .= "creditCardType = '$creditCardFilter' AND ";
}

if ($addQuery != '') {
    $query .= " WHERE " . rtrim($addQuery, " AND");
}

if ($sort != '') {
    $query = $query . " ORDER BY $sort";
    if ($order != '') {
        $query = $query . " $order";
    }
}

$flightLogsResults = executeQuery($query);

$aircraftTypeQuery = "SELECT DISTINCT(aircraftType) FROM flightlogs";
$aircraftTypeResults = executeQuery($aircraftTypeQuery);

$airlinesNameQuery = "SELECT DISTINCT (airlineName) FROM flightlogs";
$airlinesNameResults = executeQuery($airlinesNameQuery);

$pilotNameQuery = "SELECT DISTINCT (pilotName) FROM flightlogs";
$pilotNameResults = executeQuery($pilotNameQuery);

$departureTimeQuery = "SELECT DISTINCT YEAR(departureDatetime) FROM flightlogs";
$departureTimeResults = executeQuery($departureTimeQuery);

$arrivalTimeQuery = "SELECT DISTINCT YEAR(arrivalDatetime) FROM flightlogs";
$arrivalTimeResults = executeQuery($arrivalTimeQuery);

$creditCardQuery = "SELECT DISTINCT (creditCardType) FROM flightlogs";
$creditCardResults = executeQuery($creditCardQuery);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .filter-section,
        .table-section {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-section select {
            max-width: 250px;
        }

        .filter-section .form-control {
            background-color: #f1f1f1;
            border: 1px solid #ccc;
        }

        .table-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-section table th,
        .table-section table td {
            text-align: center;
            padding: 12px;
        }

        .table-section table th {
            background-color: #343a40;
            color: white;
        }

        .table-section table td {
            background-color: #f8f9fa;
        }

        .card-body {
            background-color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-label {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Filter Section -->
            <div class="col-12 filter-section">
                <form>
                    <h5 class="mb-3 text-center">Filter Flight Logs</h5>
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="mb-3">
                            <label for="departureTimeSelect" class="form-label">Departure Time</label>
                            <select id="departureTimeSelect" name="departureTime" class="form-control">
                                <option value="">Any</option>
                                <?php if (mysqli_num_rows($departureTimeResults) > 0) {
                                    while ($departureTimeRow = mysqli_fetch_assoc($departureTimeResults)) { ?>
                                        <option <?php if ($departureTimeFilter == $departureTimeRow['YEAR(departureDatetime)']) echo "selected"; ?>
                                            value="<?php echo $departureTimeRow['YEAR(departureDatetime)'] ?>">
                                            <?php echo $departureTimeRow['YEAR(departureDatetime)'] ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="arrivalTimeSelect" class="form-label">Arrival Time</label>
                            <select id="arrivalTimeSelect" name="arrivalTime" class="form-control">
                                <option value="">Any</option>
                                <?php if (mysqli_num_rows($arrivalTimeResults) > 0) {
                                    while ($arrivalTimeRow = mysqli_fetch_assoc($arrivalTimeResults)) { ?>
                                        <option <?php if ($arrivalTimeFilter == $arrivalTimeRow['YEAR(arrivalDatetime)']) echo "selected"; ?>
                                            value="<?php echo $arrivalTimeRow['YEAR(arrivalDatetime)'] ?>">
                                            <?php echo $arrivalTimeRow['YEAR(arrivalDatetime)'] ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="aircraftTypeSelect" class="form-label">Aircraft Type</label>
                            <select id="aircraftTypeSelect" name="aircraftType" class="form-control">
                                <option value="">Any</option>
                                <?php if (mysqli_num_rows($aircraftTypeResults) > 0) {
                                    while ($aircraftTypeRow = mysqli_fetch_assoc($aircraftTypeResults)) { ?>
                                        <option <?php if ($aircraftTypeFilter == $aircraftTypeRow['aircraftType']) echo "selected"; ?>
                                            value="<?php echo $aircraftTypeRow['aircraftType'] ?>">
                                            <?php echo $aircraftTypeRow['aircraftType'] ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="airlineNameSelect" class="form-label">Airline Name</label>
                            <select id="airlineNameSelect" name="airlineName" class="form-control">
                                <option value="">Any</option>
                                <?php if (mysqli_num_rows($airlinesNameResults) > 0) {
                                    while ($airlineNameRow = mysqli_fetch_assoc($airlinesNameResults)) { ?>
                                        <option <?php if ($airlinesNameFilter == $airlineNameRow['airlineName']) echo "selected"; ?>
                                            value="<?php echo $airlineNameRow['airlineName'] ?>">
                                            <?php echo $airlineNameRow['airlineName'] ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pilotNameSelect" class="form-label">Pilot Name</label>
                            <select id="pilotNameSelect" name="pilotName" class="form-control">
                                <option value="">Any</option>
                                <?php if (mysqli_num_rows($pilotNameResults) > 0) {
                                    while ($pilotNameRow = mysqli_fetch_assoc($pilotNameResults)) { ?>
                                        <option <?php if ($pilotNameFilter == $pilotNameRow['pilotName']) echo "selected"; ?>
                                            value="<?php echo $pilotNameRow['pilotName'] ?>">
                                            <?php echo $pilotNameRow['pilotName'] ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="creditCardSelect" class="form-label">Credit Card</label>
                            <select id="creditCardSelect" name="creditCard" class="form-control">
                                <option value="">Any</option>
                                <?php if (mysqli_num_rows($creditCardResults) > 0) {
                                    while ($creditCardRow = mysqli_fetch_assoc($creditCardResults)) { ?>
                                        <option <?php if ($creditCardFilter == $creditCardRow['creditCardType']) echo "selected"; ?>
                                            value="<?php echo $creditCardRow['creditCardType'] ?>">
                                            <?php echo $creditCardRow['creditCardType'] ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row pt-3">
                        <div class="h5">Sort</div>
                        <label for="sort" class="ms-2">Sort By</label>
                        <select id="sort" name="sort" class="ms-2 form-control" style="width: fit-content;">
                            <option value="">None</option>
                            <option <?php if ($sort == "departureDatetime") {
                                        echo "selected";
                                    } ?> value="departureDatetime">Departure Time</option>
                            <option <?php if ($sort == "arrivalDatetime") {
                                        echo "selected";
                                    } ?> value="arrivalDatetime">Arrival Time</option>
                            <option <?php if ($sort == "flightDurationMinutes") {
                                        echo "selected";
                                    } ?> value="flightDurationMinutes">Flight Duration</option>
                            <option <?php if ($sort == "airlineName") {
                                        echo "selected";
                                    } ?> value="airlineName">Airline Name</option>
                            <option <?php if ($sort == "aircraftType") {
                                        echo "selected";
                                    } ?> value="aircraftType">Aircraft Type</option>
                            <option <?php if ($sort == "passengerCount") {
                                        echo "selected";
                                    } ?> value="passengerCount">Passenger Count</option>
                            <option <?php if ($sort == "pilotName") {
                                        echo "selected";
                                    } ?> value="pilotName">Pilot Name</option>
                            <option <?php if ($sort == "creditCardType") {
                                        echo "selected";
                                    } ?> value="creditCardType">Credit Card</option>
                        </select>

                        <label for="order" class="ms-2">Order</label>
                        <select id="order" name="order" class="ms-2 form-control" style="width: fit-content;">
                            <option <?php if ($order == "ASC") {
                                        echo "selected";
                                    } ?> value="ASC">Ascending</option>
                            <option <?php if ($order == "DESC") {
                                        echo "selected";
                                    } ?> value="DESC">Descending</option>
                        </select>
                    </div>


                    <div class="d-flex justify-content-center pt-3">
                        <button class="btn btn-primary">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">

            <div class="col-12 table-section">
                <h5 class="text-center mb-4">Flight Logs</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Departure Time</th>
                            <th>Arrival Time</th>
                            <th>Flight Duration</th>
                            <th>Airline Name</th>
                            <th>Aircraft Type</th>
                            <th>Passenger Count</th>
                            <th>Pilot Name</th>
                            <th>Credit Card</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($flightLogsResults) > 0) {
                            while ($flightLogsRow = mysqli_fetch_assoc($flightLogsResults)) {
                                echo "<tr>
                                    <td>{$flightLogsRow['flightNumber']}</td>
                                    <td>{$flightLogsRow['departureDatetime']}</td>
                                    <td>{$flightLogsRow['arrivalDatetime']}</td>
                                    <td>{$flightLogsRow['flightDurationMinutes']}</td>
                                    <td>{$flightLogsRow['airlineName']}</td>
                                    <td>{$flightLogsRow['aircraftType']}</td>
                                    <td>{$flightLogsRow['passengerCount']}</td>
                                    <td>{$flightLogsRow['pilotName']}</td>
                                    <td>{$flightLogsRow['creditCardType']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>No flight logs found for this filter</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>