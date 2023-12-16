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

            <form id="searchForm"  onsubmit="updateAction()" method="post">
            <table>
                <tr>
                    <td>
                        <input type="search"  name="query" placeholder="Search...">
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


            <div class="container1">
                <table>
                    <?php
                    if (isset($data) && is_array($data) && !empty($data)) {
                        foreach ($data as $iteration => $user) {
                            $boxClass = (int)$iteration % 2 === 1 ? 'grey-round-box1' : 'grey-round-box2';
                    ?>
                            <tr class="<?php echo $boxClass; ?>">
                                <td><?php echo isset($user['FNAME']) ? htmlspecialchars($user['FNAME']) : ''; ?></td>
                                <td><?php echo isset($user['LNAME']) ? htmlspecialchars($user['LNAME']) : ''; ?></td>
                                <td><?php echo isset($user['EMAIL']) ? htmlspecialchars($user['EMAIL']) : ''; ?></td>
                                <td><?php echo isset($user['PHONE']) ? htmlspecialchars($user['PHONE']) : ''; ?></td>
                                <td>
                                    <form method="post" action="?controller=user&action=view&id=<?php echo $user['USER_ID']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo isset($user['USER_ID']) ? $user['USER_ID'] : ''; ?>">
                                        <input type="hidden" name="group_id" value="<?php echo isset($user['GROUP_ID']) ? $user['GROUP_ID'] : ''; ?>">
                                        <button type="submit" class="view-button" name="view">View</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="5"><div class="null-box"><div class="grey-label">No client records were found.</div></div></td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <?php include_once "footer.php"; ?>
</body>

</html>
