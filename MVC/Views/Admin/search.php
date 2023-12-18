<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include_once "dashboard.php"; ?>

    <div class="center">
        <div class="profile">

            <form id="searchForm" onsubmit="updateAction()" method="post">
                <table>
                    <tr>
                        <td>
                            <input type="search" name="query" placeholder="Search...">
                        </td>
                        <td>
                            <button type="submit" class="search-button" name="search">Search</button>
                        </td>
                    </tr>
                </table>
            </form>

            <script>
                function updateAction() {
                    var lookupValue = document.getElementsByName('query')[0].value;
                    var form = document.getElementById('searchForm');
                    form.action = '?controller=user&action=search&query=' + encodeURIComponent(lookupValue);
                }
            </script>

            <?php
            $lookupTerm = isset($_POST['query']) ? $_POST['query'] : '';
            if (!empty($data)) {
                echo '<div class="container1">';
                echo '<table>';
                foreach ($data as $iteration => $user) {
                    $boxClass = (int)$iteration % 2 === 1 ? 'grey-round-box1' : 'grey-round-box2';
                    echo '<tr class="' . $boxClass . '">';
                    echo '<td>' . (isset($user['FNAME']) ? htmlspecialchars($user['FNAME']) : '') . '</td>';
                    echo '<td>' . (isset($user['LNAME']) ? htmlspecialchars($user['LNAME']) : '') . '</td>';
                    echo '<td>' . (isset($user['EMAIL']) ? htmlspecialchars($user['EMAIL']) : '') . '</td>';
                    echo '<td>' . (isset($user['PHONE']) ? htmlspecialchars($user['PHONE']) : '') . '</td>';
                    echo '<td>';
                    echo '<form method="post" action="?controller=user&action=view&id=' . (isset($user['USER_ID']) ? $user['USER_ID'] : '') . '">';
                    echo '<input type="hidden" name="user_id" value="' . (isset($user['USER_ID']) ? $user['USER_ID'] : '') . '">';
                    echo '<input type="hidden" name="group_id" value="' . (isset($user['GROUP_ID']) ? $user['GROUP_ID'] : '') . '">';
                    echo '<button type="submit" class="view-button" name="view">View</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="null-box" style="text-align:center;">';
                echo '<table>';
                echo '<tr>';
                echo '<td style="text-align:center;"><div class="grey-label">Search for \'' . htmlspecialchars($lookupTerm) . '\'</div></td>';
                echo '<td style="text-align:center;"><div class="grey-label">No matching records found. Please refine your search by entering the client\'s first or last name.</div></td>';
                echo '</tr>';
                echo '</table>';
                echo '</div>';
            }
            ?>

        </div>
    </div>

    <?php include "footer.php"; ?>

</body>

</html>
