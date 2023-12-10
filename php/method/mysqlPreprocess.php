<?php
function mysqlPreprocess($link, $sql, $types, ...$var)
{
	try {
		$result = false;
		$stmt = $link->stmt_init();
		$stmt->prepare($sql);

		if ($types) {
			$stmt->bind_param($types, ...$var);
		}

		if ($stmt->execute()) {
			if ($row = $stmt->get_result()) {
				$result = $row->fetch_all(MYSQLI_ASSOC);
			} else {
				$result = true;
			}
		}
	} finally {
		$stmt->close();
		return $result;
	}
}
